 <?php
if (!function_exists('config')) {
    function config(string $key) {

        $config = explode('.', $key);
        if (count($config) > 0) {
            var_dump(base_path('config/'.$config[0]));
            $result = include base_path('config/' . $config[0]);
            return $result[$config[1]];
        }
        return null;
    }
}

if (!function_exists('base_path')) {
    function base_path($path) {
        return getcwd() . "/" . $path . ".php";
    }
}
?> 
