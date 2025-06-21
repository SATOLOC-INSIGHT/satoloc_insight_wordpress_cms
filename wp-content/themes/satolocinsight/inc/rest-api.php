<?php
ini_set('error_reporting', E_STRICT);
ini_set('memory_limit', -1);

require_once __DIR__ . '/../helpers/contents.php';

function register_routes()
{

    // Homepage Content API endpoint
    register_rest_route('satoloc/v1', 'homepage-content', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'get_homepage_content',
        'permission_callback' => '__return_true' // Public endpoint
    ));


    error_log('Routes registered successfully');
}

add_action('rest_api_init', 'register_routes');

// Function to get homepage content
function get_homepage_content($request) {
    // Get the Homepage page by slug
    $homepage_page = get_page_by_path('homepage');
    
    // Fallback: if not found by slug, try to find by title
    if (!$homepage_page) {
        $pages = get_posts(array(
            'post_type' => 'page',
            'post_status' => 'publish',
            'title' => 'Homepage',
            'numberposts' => 1
        ));
        if (!empty($pages)) {
            $homepage_page = $pages[0];
        }
    }

    if (!$homepage_page || $homepage_page->post_status !== 'publish') {
        return new WP_Error('no_content', 'Homepage not found or not published', array('status' => 404));
    }

    // Get ACF fields using your structure
    $frontend_header = get_field('frontend_header', $homepage_page->ID);
    $key_features = get_field('key_features', $homepage_page->ID);
    $strategy_section = get_field('strategy_section', $homepage_page->ID);
    $award_section = get_field('award_section', $homepage_page->ID);
    $roadmap = get_field('roadmap', $homepage_page->ID);
    $pricing = get_field('pricing', $homepage_page->ID);
    $pricing_title = get_field('pricing_title', $homepage_page->ID);
    $pricing_description = get_field('pricing_description', $homepage_page->ID);
    $main_faq = get_field('main_faq', $homepage_page->ID);
    $auto_lqa = get_field('auto_lqa', $homepage_page->ID);

    // Prepare FAQ items array
    $faq_items = array();
    $faq_keys = array('one_faq', 'two_faq', 'three_faq', 'four_faq', 'five_faq', 'six_faq', 
                     'seven_faq', 'eight_faq', 'nine_faq', 'ten_faq', 'eleven_faq', 'twelve_faq',
                     'thirteen_faq', 'fourteen_faq', 'fifteen_faq', 'sixteen_faq', 'seventeen_faq', 'eighteen_faq');
    
    foreach ($faq_keys as $faq_key) {
        if (!empty($main_faq[$faq_key]['question']) && !empty($main_faq[$faq_key]['answer'])) {
            $faq_items[] = array(
                'question' => $main_faq[$faq_key]['question'],
                'answer' => $main_faq[$faq_key]['answer']
            );
        }
    }

    // Process pricing data
    $pricing_plans = array();
    
    // Helper function to process features
    function process_features($features) {
        $processed_features = array();
        $feature_keys = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');
        
        foreach ($feature_keys as $feature_key) {
            if (!empty($features[$feature_key]['name'])) {
                $processed_features[] = array(
                    'name' => $features[$feature_key]['name'],
                    'included' => !empty($features[$feature_key]['included'])
                );
            }
        }
        
        return $processed_features;
    }

    // Process Freemium plan
    if (!empty($pricing['freemium']['is_free']) && !empty($pricing['freemium']['free_subscription'])) {
        $free_plan = $pricing['freemium']['free_subscription'];
        $pricing_plans['freemium'] = array(
            'name' => $free_plan['name'] ?? null,
            'description' => $free_plan['description'] ?? null,
            'price' => $free_plan['price'] ?? null,
            'annual_price' => $free_plan['annual_price'] ?? null,
            'discount' => $free_plan['discount'] ?? null,
            'audience' => $free_plan['audience'] ?? null,
            'translation_limit' => $free_plan['translation_limit'] ?? null,
            'content_limit' => $free_plan['content_limit'] ?? null,
            'seo_analysis' => $free_plan['seo_analysis'] ?? null,
            'team_members' => $free_plan['team_members'] ?? null,
            'features' => !empty($free_plan['features']) ? process_features($free_plan['features']) : array(),
            'button_text' => $free_plan['button_text'] ?? null,
            'button_variant' => $free_plan['button_variant'] ?? null,
            'is_coming' => !empty($pricing['freemium']['is_coming'])
        );
    }

    // Process Pro plan
    if (!empty($pricing['pro']['is_pro']) && !empty($pricing['pro']['pro_subscription'])) {
        $pro_plan = $pricing['pro']['pro_subscription'];
        $pricing_plans['pro'] = array(
            'name' => $pro_plan['name'] ?? null,
            'description' => $pro_plan['description'] ?? null,
            'price' => $pro_plan['price'] ?? null,
            'annual_price' => $pro_plan['annual_price'] ?? null,
            'discount' => $pro_plan['discount'] ?? null,
            'audience' => $pro_plan['audience'] ?? null,
            'translation_limit' => $pro_plan['translation_limit'] ?? null,
            'content_limit' => $pro_plan['content_limit'] ?? null,
            'seo_analysis' => $pro_plan['seo_analysis'] ?? null,
            'team_members' => $pro_plan['team_members'] ?? null,
            'features' => !empty($pro_plan['features']) ? process_features($pro_plan['features']) : array(),
            'button_text' => $pro_plan['button_text'] ?? null,
            'button_variant' => $pro_plan['button_variant'] ?? null,
            'is_coming' => !empty($pricing['pro']['is_coming'])
        );
    }

    // Process Premium plan
    if (!empty($pricing['premium']['is_premium']) && !empty($pricing['premium']['premium_subscription'])) {
        $premium_plan = $pricing['premium']['premium_subscription'];
        $pricing_plans['premium'] = array(
            'name' => $premium_plan['name'] ?? null,
            'description' => $premium_plan['description'] ?? null,
            'price' => $premium_plan['price'] ?? null,
            'annual_price' => $premium_plan['annual_price'] ?? null,
            'discount' => $premium_plan['discount'] ?? null,
            'audience' => $premium_plan['audience'] ?? null,
            'translation_limit' => $premium_plan['translation_limit'] ?? null,
            'content_limit' => $premium_plan['content_limit'] ?? null,
            'seo_analysis' => $premium_plan['seo_analysis'] ?? null,
            'team_members' => $premium_plan['team_members'] ?? null,
            'features' => !empty($premium_plan['features']) ? process_features($premium_plan['features']) : array(),
            'button_text' => $premium_plan['button_text'] ?? null,
            'button_variant' => $premium_plan['button_variant'] ?? null,
            'is_coming' => !empty($pricing['premium']['is_coming'])
        );
    }

    // Prepare response data with no defaults
    $response_data = array(
        'id' => $homepage_page->ID,
        'title' => $homepage_page->post_title,
        'header' => array(
            'title' => $frontend_header['main_title'] ?? null,
            'description' => $frontend_header['header_description'] ?? null
        ),
        'features' => array(
            'localization' => array(
                'title' => $key_features['localization']['title'] ?? null,
                'description' => $key_features['localization']['description'] ?? null
            ),
            'optimization' => array(
                'title' => $key_features['optimization']['title'] ?? null,
                'description' => $key_features['optimization']['description'] ?? null
            ),
            'analytics' => array(
                'title' => $key_features['analytics']['title'] ?? null,
                'description' => $key_features['analytics']['description'] ?? null
            ),
            'content_creation' => array(
                'title' => $key_features['content_creation']['title'] ?? null,
                'description' => $key_features['content_creation']['description'] ?? null
            ),
            'management' => array(
                'title' => $key_features['management']['title'] ?? null,
                'description' => $key_features['management']['description'] ?? null
            ),
            'autolqa' => array(
                'title' => $key_features['autolqa']['title'] ?? null,
                'description' => $key_features['autolqa']['description'] ?? null
            )
        ),
        'strategy' => array(
            'title' => $strategy_section['strategy_title'] ?? null,
            'description' => $strategy_section['strategy_description'] ?? null,
            'locate' => array(
                'title' => $strategy_section['locate']['title'] ?? null,
                'description' => $strategy_section['locate']['description'] ?? null
            ),
            'details' => array(
                'title' => $strategy_section['details']['title'] ?? null,
                'description' => $strategy_section['details']['description'] ?? null
            ),
            'insight' => array(
                'title' => $strategy_section['insight']['title'] ?? null,
                'description' => $strategy_section['insight']['description'] ?? null
            ),
            'action' => array(
                'title' => $strategy_section['action']['title'] ?? null,
                'description' => $strategy_section['action']['description'] ?? null
            )
        ),
        'awards' => array(
            'title' => $award_section['title'] ?? null,
            'description' => $award_section['description'] ?? null
        ),
        'roadmap' => array(
            'title' => $roadmap['title'] ?? null,
            'description' => $roadmap['description'] ?? null
        ),
        'pricing' => array(
            'title' => $pricing_title ?? null,
            'description' => $pricing_description ?? null,
            'plans' => $pricing_plans
        ),
        'auto_lqa' => array(
            'title' => $auto_lqa['title'] ?? null,
            'description' => $auto_lqa['description'] ?? null
        ),
        'faq' => array(
            'title' => $main_faq['faq_title'] ?? null,
            'description' => $main_faq['faq_description'] ?? null,
            'items' => $faq_items
        ),
        'updated_at' => $homepage_page->post_modified
    );

    return new WP_REST_Response($response_data, 200);
}
