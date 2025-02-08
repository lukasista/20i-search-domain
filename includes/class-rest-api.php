<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Domain_Search_REST_API {
    public static function init() {
        add_action( 'rest_api_init', [ __CLASS__, 'register_routes' ] );
    }

    public static function register_routes() {
        register_rest_route( 'domain-search/v1', '/check', [
            'methods'  => 'GET',
            'callback' => [ __CLASS__, 'check_domain' ],
            'permission_callback' => '__return_true',
        ] );
    }

    public static function check_domain( $request ) {
        $domain = sanitize_text_field( $request->get_param( 'domain' ) );

        if ( empty( $domain ) ) {
            return new WP_Error( 'no_domain', __( 'No domain provided.', 'domain-search' ), [ 'status' => 400 ] );
        }

        // API klíč z nastavení pluginu
        $api_key = get_option( 'domain_search_api_key' );

        if ( empty( $api_key ) ) {
            return new WP_Error( 'no_api_key', __( 'API key is missing.', 'domain-search' ), [ 'status' => 400 ] );
        }

        // Dotaz na API 20i
        $response = wp_remote_get( "https://api.20i.com/domain-check?domain={$domain}", [
            'headers' => [
                'Authorization' => "Bearer $api_key",
                'Accept'        => 'application/json',
            ],
        ] );

        if ( is_wp_error( $response ) ) {
            return new WP_Error( 'api_error', __( 'Failed to contact 20i API.', 'domain-search' ), [ 'status' => 500 ] );
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        if ( empty( $data ) ) {
            return new WP_Error( 'invalid_response', __( 'Invalid response from 20i API.', 'domain-search' ), [ 'status' => 500 ] );
        }

        return rest_ensure_response( $data );
    }
}

Domain_Search_REST_API::init();