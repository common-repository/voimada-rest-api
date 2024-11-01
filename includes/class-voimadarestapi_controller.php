<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
class Voimada_Rest_API extends WP_REST_Controller
{

    //The namespace and version for the REST SERVER
    var $namespace = 'voimada_api/v';
    var $version = '1';
    var $auth_key = '';
    var $response = '';



    function __construct()
    {


        $this->auth_key =  sanitize_text_field(substr(base64_encode(SECURE_AUTH_KEY), 0, 30));
    }

    public function verify_authentication($security_key)
    {


        if ($security_key == $this->auth_key) {


            return array(
                "act" => "success",
                "msg" => "Secret by passed by Root",
                "secret" => $security_key,
            );
        } else {

            return array(
                "act" => "error",
                "msg" => "invalid Request, Secret Key Required",
                "secret" => $security_key,
            );
        }
    }

    public function http_response_code($code = NULL)
    {


        // $WP_HTTP_Response = new WP_HTTP_Response();
        // echo $var = $WP_HTTP_Response->get_status();

        if ($code !== NULL) {

            switch ($code) {
                case 100:
                    $text = 'Continue';
                    break;
                case 101:
                    $text = 'Switching Protocols';
                    break;
                case 200:
                    $text = 'OK';
                    break;
                case 201:
                    $text = 'Created';
                    break;
                case 202:
                    $text = 'Accepted';
                    break;
                case 203:
                    $text = 'Non-Authoritative Information';
                    break;
                case 204:
                    $text = 'No Content';
                    break;
                case 205:
                    $text = 'Reset Content';
                    break;
                case 206:
                    $text = 'Partial Content';
                    break;
                case 300:
                    $text = 'Multiple Choices';
                    break;
                case 301:
                    $text = 'Moved Permanently';
                    break;
                case 302:
                    $text = 'Moved Temporarily';
                    break;
                case 303:
                    $text = 'See Other';
                    break;
                case 304:
                    $text = 'Not Modified';
                    break;
                case 305:
                    $text = 'Use Proxy';
                    break;
                case 400:
                    $text = 'Bad Request';
                    break;
                case 401:
                    $text = 'Unauthorized';
                    break;
                case 402:
                    $text = 'Payment Required';
                    break;
                case 403:
                    $text = 'Forbidden';
                    break;
                case 404:
                    $text = 'Not Found';
                    break;
                case 405:
                    $text = 'Method Not Allowed';
                    break;
                case 406:
                    $text = 'Not Acceptable';
                    break;
                case 407:
                    $text = 'Proxy Authentication Required';
                    break;
                case 408:
                    $text = 'Request Time-out';
                    break;
                case 409:
                    $text = 'Conflict';
                    break;
                case 410:
                    $text = 'Gone';
                    break;
                case 411:
                    $text = 'Length Required';
                    break;
                case 412:
                    $text = 'Precondition Failed';
                    break;
                case 413:
                    $text = 'Request Entity Too Large';
                    break;
                case 414:
                    $text = 'Request-URI Too Large';
                    break;
                case 415:
                    $text = 'Unsupported Media Type';
                    break;
                case 500:
                    $text = 'Internal Server Error';
                    break;
                case 501:
                    $text = 'Not Implemented';
                    break;
                case 502:
                    $text = 'Bad Gateway';
                    break;
                case 503:
                    $text = 'Service Unavailable';
                    break;
                case 504:
                    $text = 'Gateway Time-out';
                    break;
                case 505:
                    $text = 'HTTP Version not supported';
                    break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);
        }

        return $code;
    }

    public function get_status_message($code = 200)
    {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            1001 => 'Parameters required!',
            1002 => 'No Results Found'
        );


        return (isset($status[$code])) ? $status[$code] : $status[200];
    }

    public function response($code = '', $response, $_authintication, $data = array())
    {
        $code = (isset($code)) ? $code : 200;
        $this->response =  array(
            'status' => $this->get_status_message($code),
            'response' => $response,
            'code' => $code,
            'data' => $data
        );

        return $this->response;
        exit;
    }

    public function request_url()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $actual_link;
    }


    //register endpoints with base
    public function register_routes()
    {

        $namespace = $this->namespace . $this->version;

        $get_points = array(
            "post" => array(
                "callback" => array(
                    "callback" => "voimadarestapi_callbacka"
                ),

            ),
        );

        foreach ($get_points as $registered_base => $basedata) {
            if ($registered_base) {

                $code = register_rest_route($namespace, '/' . $registered_base, array(
                    array(
                        'methods' => WP_REST_Server::ALLMETHODS,
                        'callback' => function ($request) {
                            $parameters = $request->get_params();
                            $secret_key = sanitize_text_field($request->get_param('secret_key'));
                            $_authintication = $this->verify_authentication($secret_key);
                            $callback = 'voimadarestapi_callbacka';


                            if ($_authintication['act'] == 'error') {
                                $error = $this->response($this->http_response_code(), $_authintication['msg'], $_authintication, $secret_key);
                                return $error;
                            }


                            if (has_filter($callback)) {

                                $parameters['requested_url'] = $this->request_url();
                                return $this->response($this->http_response_code(), 'Response OK', $_authintication, apply_filters($callback, $parameters));
                            }


                            return $response = $this->response(200, 'Connection OK', $_authintication, $parameters);
                        },
                        'permission_callback' => function () {
                            return true;
                        }
                    ),

                ));

                add_filter("voimadarestapi_callbacka", array(
                    $this,
                    "voimadarestapi_callbacka_handler"
                ));
            }
        }
    }

    // Register our REST Server
    public function hook_rest_server()
    {
        add_action('rest_api_init', array(
            $this,
            'register_routes'
        ));
    }

    public function voimadarestapi_callbacka_handler($param)
    {
        global $user_ID;


        /*        $schema = array(
            'post_title' => array('name' => 'title','type'=> 'text','required'=>true),
            'post_content' => array('name' => 'content','type'=> 'html','required'=>true),
            'post_status' => array('name' => 'status','type'=> 'list','valid_item'=>array('publish','unpublished','future','closed'),'required'=>true),
            'post_date' =>  array('name' => 'date','type'=> 'date','required'=>true),
            'post_author' => array('name' => 'uid','type'=> 'number','required'=>true),
            'post_type' => array('name' => 'type','type'=> 'text','required'=>true),
            'post_category' => array('name' => 'category','type'=> 'array','required'=>true)
        );

        foreach ($schema as $param) {
        	

        }*/

        $require_field = (isset($param['title']) && isset($param['content']));


        if ($require_field) {

            $categories = is_array($param['categories']) ? $param['categories'] : [];
            array_push($categories, 'Voimada');

            $category_ids = [];
            foreach ($categories as $cat) {
                $temp = get_cat_ID($cat);
                if ($temp != 0) {
                    array_push($category_ids, $temp);
                }
            }


            $new_post = array(
                'post_title' => $param['title'],
                'post_content' => $param['content'],
                'post_status' => 'publish',
                'post_date' => date('Y-m-d H:i:s'),
                'post_author' => $user_ID,
                'post_type' => 'post',
                'post_category' => $category_ids
            );
            $post_id = wp_insert_post($new_post);

            return $post_id;
        } else {

            $error = $this->response($this->http_response_code(400), 'Required Data: Title, Content', $param, $param);
            return $error;
        }
    }

    public function get_latest_post(WP_REST_Request $request)
    {

        //Let Us use the helper methods to get the parameters
        $category = $request->get_param('category');
        $post = get_posts(array(
            'category' => $category,
            'posts_per_page' => 1,
            'offset' => 0
        ));

        if (empty($post)) {
            return null;
        }

        return $post[0]->post_title;
    }

    public function add_post_to_category_permission()
    {
        if (!current_user_can('edit_posts')) {
            return new WP_Error('rest_forbidden', esc_html__('You do not have permissions to create data.', 'my-text-domain'), array(
                'status' => 401
            ));
        }
        return true;
    }

    public function add_post_to_category(WP_REST_Request $request)
    {
        //Let Us use the helper methods to get the parameters
        $args = array(
            'post_title' => $request->get_param('title'),
            'post_category' => array(
                $request->get_param('category')
            )
        );

        if (false !== ($id = wp_insert_post($args))) {
            return get_post($id);
        }

        return false;
    }
}

$rest_server = new Voimada_Rest_API();
$rest_server->hook_rest_server();
