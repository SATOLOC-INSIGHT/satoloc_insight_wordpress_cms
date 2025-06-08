<?php
/**
 * Plugin Name: SatoLOC CORS Fix
 * Description: Handles CORS headers for SatoLOC Insight API requests
 * Version: 1.0
 * Author: SatoLOC Team
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class SatoLocCORSFix {
    
    public function __construct() {
        add_action('init', array($this, 'handle_preflight'));
        add_action('rest_api_init', array($this, 'add_cors_headers'));
        add_filter('rest_pre_serve_request', array($this, 'add_cors_headers_to_response'), 10, 4);
    }
    
    /**
     * Handle preflight OPTIONS requests
     */
    public function handle_preflight() {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            $this->send_cors_headers();
            http_response_code(200);
            exit;
        }
    }
    
    /**
     * Add CORS headers to REST API responses
     */
    public function add_cors_headers() {
        $this->send_cors_headers();
    }
    
    /**
     * Add CORS headers to REST API response
     */
    public function add_cors_headers_to_response($served, $result, $request, $server) {
        $this->send_cors_headers();
        return $served;
    }
    
    /**
     * Send CORS headers
     */
    private function send_cors_headers() {
        $allowed_origins = array(
            'https://satolocinsight.com',
            'https://www.satolocinsight.com',
            'http://localhost:3000',
            'http://localhost:3001',
            'https://localhost:3000',
            'https://localhost:3001'
        );
        
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        
        if (in_array($origin, $allowed_origins)) {
            header('Access-Control-Allow-Origin: ' . $origin);
        } else {
            // Fallback for production
            header('Access-Control-Allow-Origin: https://satolocinsight.com');
        }
        
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, Cache-Control, X-WP-Nonce');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Expose-Headers: X-WP-Total, X-WP-TotalPages');
        header('Access-Control-Max-Age: 86400');
        
        // Specific headers for WordPress REST API
        header('Vary: Origin');
    }
}

// Initialize the plugin
new SatoLocCORSFix();

/**
 * Custom REST API endpoint for testing
 */
add_action('rest_api_init', function () {
    register_rest_route('satoloc/v1', '/homepage-content', array(
        'methods' => 'GET',
        'callback' => 'satoloc_get_homepage_content',
        'permission_callback' => '__return_true',
    ));
});

function satoloc_get_homepage_content() {
    return new WP_REST_Response(array(
        'status' => 'success',
        'message' => 'CORS working correctly!',
        'data' => array(
            'title' => 'SatoLOC Insight',
            'description' => 'Your headless CMS is working',
            'timestamp' => current_time('mysql')
        )
    ), 200);
} 