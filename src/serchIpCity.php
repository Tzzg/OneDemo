//给某个ip找到对应的省和市，要求效率竟可能的高#
//ip2long，把所有城市的最小和最大Ip录进去
$redis_key = 'ip';
$redis->zAdd($redis_key, 20, '#bj');//北京的最小IP加#
$resid->zAdd($redis_key, 30, 'bj');//最大IP

function get_ip_city($ip_address)
{
    $ip = ip2long($ip_address);

    $redis_key = 'ip';
    $city = zRangeByScore($redis_key, $ip, '+inf', array('limit' => array(0, 1)));
    if ($city) {
        if (strpos($city[0], "#") === 0) {
            echo '城市不存在!';
        } else {
            echo '城市是' . $city[0];
        }
    } else {
        echo '城市不存在!';
    }
}