#!/bin/bash

# SatoLOC WordPress CMS Management Script
# Usage: ./scripts/wordpress-setup.sh [start|stop|restart|reset|logs|status]

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
COMPOSE_FILE="$PROJECT_DIR/docker-compose.wordpress.yml"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if Docker is running
check_docker() {
    if ! docker info > /dev/null 2>&1; then
        print_error "Docker is not running. Please start Docker and try again."
        exit 1
    fi
}

# Start WordPress environment
start_wordpress() {
    print_status "Starting SatoLOC WordPress CMS environment..."
    check_docker
    
    cd "$PROJECT_DIR"
    
    # Create wordpress-data directory if it doesn't exist
    if [ ! -d "wordpress-data" ]; then
        mkdir -p wordpress-data
        print_status "Created wordpress-data directory"
    fi
    
    # Start containers
    docker-compose -f "$COMPOSE_FILE" up -d
    
    print_success "WordPress environment started successfully!"
    print_status "WordPress Admin: http://localhost:8080/wp-admin"
    print_status "phpMyAdmin: http://localhost:8081"
    print_status "Database: localhost:3307"
    print_warning "Please wait 30-60 seconds for all services to be ready"
}

# Stop WordPress environment
stop_wordpress() {
    print_status "Stopping SatoLOC WordPress CMS environment..."
    check_docker
    
    cd "$PROJECT_DIR"
    docker-compose -f "$COMPOSE_FILE" down
    
    print_success "WordPress environment stopped successfully!"
}

# Restart WordPress environment
restart_wordpress() {
    print_status "Restarting SatoLOC WordPress CMS environment..."
    stop_wordpress
    sleep 2
    start_wordpress
}

# Reset WordPress environment (removes all data)
reset_wordpress() {
    print_warning "This will remove ALL WordPress data including posts, users, and database!"
    read -p "Are you sure you want to continue? (y/N): " -n 1 -r
    echo
    
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        print_status "Resetting WordPress environment..."
        check_docker
        
        cd "$PROJECT_DIR"
        
        # Stop and remove containers, networks, and volumes
        docker-compose -f "$COMPOSE_FILE" down -v --remove-orphans
        
        # Remove wordpress-data directory
        if [ -d "wordpress-data" ]; then
            rm -rf wordpress-data
            print_status "Removed wordpress-data directory"
        fi
        
        print_success "WordPress environment reset successfully!"
        print_status "Run './scripts/wordpress-setup.sh start' to create a fresh installation"
    else
        print_status "Reset cancelled"
    fi
}

# Show logs
show_logs() {
    print_status "Showing WordPress container logs..."
    check_docker
    
    cd "$PROJECT_DIR"
    docker-compose -f "$COMPOSE_FILE" logs -f wordpress
}

# Show status
show_status() {
    print_status "WordPress Environment Status:"
    check_docker
    
    cd "$PROJECT_DIR"
    docker-compose -f "$COMPOSE_FILE" ps
}

# Main script logic
case "${1:-help}" in
    start)
        start_wordpress
        ;;
    stop)
        stop_wordpress
        ;;
    restart)
        restart_wordpress
        ;;
    reset)
        reset_wordpress
        ;;
    logs)
        show_logs
        ;;
    status)
        show_status
        ;;
    help|*)
        echo "SatoLOC WordPress CMS Management Script"
        echo ""
        echo "Usage: $0 [command]"
        echo ""
        echo "Commands:"
        echo "  start     Start the WordPress environment"
        echo "  stop      Stop the WordPress environment"
        echo "  restart   Restart the WordPress environment"
        echo "  reset     Reset WordPress (removes all data)"
        echo "  logs      Show WordPress container logs"
        echo "  status    Show container status"
        echo "  help      Show this help message"
        echo ""
        echo "After starting, access:"
        echo "  WordPress Admin: http://localhost:8080/wp-admin"
        echo "  phpMyAdmin: http://localhost:8081"
        ;;
esac 