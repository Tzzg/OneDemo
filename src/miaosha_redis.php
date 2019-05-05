$ttl = 4;
$random = mt_rand(1,1000).'-'.gettimeofday(true).'-'.mt_rand(1,1000);

$lock = fasle;
while (!$lock) {
    $lock = $redis->set('lock', $random, array('nx', 'ex' => $ttl));
}

if ($redis->get('goods.num') <= 0) {
    echo ("秒杀已经结束");
    //删除锁
    if ($redis->get('lock') == $random) {
        $redis->del('lock');
    }
    return false;
}

$redis->decr('goods.num');
echo ("秒杀成功");
//删除锁
if ($redis->get('lock') == $random) {
    $redis->del('lock');
}
return true;