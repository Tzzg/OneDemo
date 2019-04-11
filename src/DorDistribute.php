<?php

class DD
{

    /**
     * 随机获得数组键值
     * @param $array
     * @param null $number
     * @return array
     */
    public static function array_random($array, $number = null)
    {
        $requested = is_null($number) ? 1 : $number;

        $count = count($array);

        if ($requested > $count) {
            exit;
        }

        if (is_null($number)) {
            return $array[array_rand($array)];
        }

        if ((int)$number === 0) {
            return [];
        }

        $keys = array_rand($array, $number);

        $results = [];

        foreach ((array)$keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }

    /**
     * 随机获得汉字字符
     * @param $num 为生成汉字的数量
     * @return string
     */
    private static function getChar($num)
    {
        $b = '';
        for ($i = 0; $i < $num; $i++) {
            // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
            $a = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
            // 转码
            $b .= iconv('GB2312', 'UTF-8', $a);
        }
        return $b;
    }


    /**
     * //初始化 全部 学生   7个宿舍  6人间
     * @return array
     */
    private static function initStudent()
    {
        //7*6
        //姓名 学号 性别 还有4个数字

        //生成整个班的学生信息
        //学号的 基数值
        $now = time();
        //性别
        $sex = ['男'];

        $students = [];
        for ($i = 0; $i < 7 * 6; $i++) {

            $students[$i]['num'] = $now + $i;
            $students[$i]['name'] = self::randName();
            $students[$i]['sex'] = self::array_random($sex);
            //量化指标
            //随机
            $q_arr = [1, 2, 3, 4, -1, -2, -3, -4];
            $students[$i]['q1'] = self::array_random($q_arr);
            $students[$i]['q2'] = self::array_random($q_arr);
            $students[$i]['q3'] = self::array_random($q_arr);
            $students[$i]['q4'] = self::array_random($q_arr);

        }

        return $students;
    }

    /**
     * 随机姓名
     * @return string
     */
    private static function randName()
    {

        //姓
        $xing = array('赵', '钱', '孙', '李', '周', '吴', '郑', '王', '冯', '陈', '褚', '卫', '蒋', '沈', '韩', '杨',
            '朱', '秦', '尤', '许', '何', '吕', '施', '张', '孔', '曹', '严', '华', '金', '魏', '陶', '姜', '戚', '谢', '邹', '喻',
            '柏', '水', '窦', '章', '云', '苏', '潘', '葛', '奚', '范', '彭', '郎', '鲁', '韦', '昌', '马', '苗', '凤', '花', '方',
            '任', '袁', '柳', '鲍', '史', '唐', '费', '薛', '雷', '贺', '倪', '汤', '滕', '殷', '罗', '毕', '郝', '安', '常', '傅',
            '卞', '齐', '元', '顾', '孟', '平', '黄', '穆', '萧', '尹', '姚', '邵', '湛', '汪', '祁', '毛', '狄', '米', '伏', '成',
            '戴', '谈', '宋', '茅', '庞', '熊', '纪', '舒', '屈', '项', '祝', '董', '梁', '杜', '阮', '蓝', '闵', '季', '贾', '路',
            '娄', '江', '童', '颜', '郭', '梅', '盛', '林', '钟', '徐', '邱', '骆', '高', '夏', '蔡', '田', '樊', '胡', '凌', '霍',
            '虞', '万', '支', '柯', '管', '卢', '莫', '柯', '房', '裘', '缪', '解', '应', '宗', '丁', '宣', '邓', '单', '杭', '洪',
            '包', '诸', '左', '石', '崔', '吉', '龚', '程', '嵇', '邢', '裴', '陆', '荣', '翁', '荀', '于', '惠', '甄', '曲', '封',
            '储', '仲', '伊', '宁', '仇', '甘', '武', '符', '刘', '景', '詹', '龙', '叶', '幸', '司', '黎', '溥', '印', '怀', '蒲',
            '邰', '从', '索', '赖', '卓', '屠', '池', '乔', '胥', '闻', '莘', '党', '翟', '谭', '贡', '劳', '逄', '姬', '申', '扶',
            '堵', '冉', '宰', '雍', '桑', '寿', '通', '燕', '浦', '尚', '农', '温', '别', '庄', '晏', '柴', '瞿', '阎', '连', '习',
            '容', '向', '古', '易', '廖', '庾', '终', '步', '都', '耿', '满', '弘', '匡', '国', '文', '寇', '广', '禄', '阙', '东',
            '欧', '利', '师', '巩', '聂', '关', '荆', '司马', '上官', '欧阳', '夏侯', '诸葛', '闻人', '东方', '赫连', '皇甫',
            '尉迟', '公羊', '澹台', '公冶', '宗政', '濮阳', '淳于', '单于', '太叔', '申屠', '公孙', '仲孙', '轩辕', '令狐',
            '徐离', '宇文', '长孙', '慕容', '司徒', '司空');
        return self::array_random($xing) . self::getChar(rand(1, 2));
    }

    /**
     * 打印所有学生
     * @param $students
     */
    private static function echoAllStudents($students)
    {

        $head = ['学号', '姓名', '性别', '指标1', '指标2', '指标3', '指标4'];

        echo implode("\t", $head) . "\n";
        if (empty($students)) return;
        foreach ($students as $student) {
            echo implode("\t", $student) . "\n";
        }
        echo "\n";

    }

    /**
     * 入口
     */
    public static function run()
    {

        $students = self::initStudent();

        $old_data = $students;
        self::echoAllStudents($students);

        //按照房间容量 分组
        //分成 6组
        //先打乱顺序
        shuffle($students);
        $students = array_chunk($students, 7);

        $rooms = [];
        $ver_arr = [];
        echo '----------贪心算法开始分配房间---------' . "\n";

        //遍历所有分组
        foreach ([101, 102, 103, 104, 105, 106, 107] as $room_id) {


            echo '现在是房间' . $room_id . "\n";
            foreach ($students as $key => &$row) {

                $tem = '';
                if ($key == 0) {
                    //从第一行//随机取出一名学生 入住 房间$rooms[$k]
                    $one_key = array_rand($row);

                    $rooms[$room_id][0] = $row[$one_key];

                    echo '从第一行随机抽取学生入住房间' . $room_id . "\n";
                    echo '该名学生信息是 ' . implode('|', $row[$one_key]) . "\n";
                    //去掉这个人
                    unset($row[$one_key]);
                } else {
                    //非第一行的话 就开始找 学生
                    //遍历这一分组 , 找出让标准差最小的那个学生
                    $tem_min = ''; //平方差最小的那个值
                    $tem_stu = []; //平方差最小的那个学生
                    $tem_key = '';


                    echo '从第' . ($key + 1) . '行  选取学生入住房间' . $room_id . "\n";

                    foreach ($row as $k => $st) {
                        //计算 这列学生  与 原入住人的标准差
                        $ping = self::checkRes($rooms[$room_id], $st);

                        $tem_min = (($ping > $tem_min) && !empty($tem_stu)) ? $tem_min : $ping;//临时最小值
                        $tem_stu = (($ping > $tem_min) && !empty($tem_stu)) ? $tem_stu : $st;//临时最小学生
                        $tem_key = (($ping > $tem_min) && !empty($tem_stu)) ? $tem_key : $k;//临时最小值
                    }

                    //如果是最小 就放入这个 房间
                    $rooms[$room_id][] = $tem_stu;

                    echo '该名学生信息是 ' . implode('|', $tem_stu) . "\n";
                    unset($row[$tem_key]);//剔除
                    //房间满了跳出
                    if (count($rooms[$room_id]) == 6) break;
                }
                if (count($rooms[$room_id]) == 6) break;

            }
            $ver_arr[$room_id] = self::doThisRoomRes($rooms[$room_id]);
            //输出这个房间的标准差
            echo '这个房间的标准差 之和为' . $ver_arr[$room_id] . "\n";
            echo "\n";

        }
        echo "\n" . '该方法标准差平均值为' . self::getAvg($ver_arr) . "\n";


        echo "\n" . '----------学号顺序分配房间---------' . "\n";
        $ver_arr_1 = [];
        $old_data = array_chunk($old_data, 6);//学号顺序分割

        foreach ([101, 102, 103, 104, 105, 106, 107] as $key => $room_id) {

            echo '现在是房间' . $room_id . "\n";

            echo '房间学生为:' . "\n";

            foreach ($old_data[$key] as $student) {
                echo implode('|', $student) . "\n";
            }

            $ver_arr_1[$room_id] = self::doThisRoomRes($old_data[$key]);

            echo '这个房间的标准差 之和为' . $ver_arr_1[$room_id] . "\n";

            echo "\n";
        }

        echo "\n" . '该方法标准差平均值为' . self::getAvg($ver_arr_1) . "\n";

    }

    /**
     * 计算标准差  之和
     * a为 总数组  b 为 待入库数组
     * @param $a
     * @param $b
     * @return number
     */
    private static function checkRes($a, $b)
    {
        $a[] = $b;

        $parm = ['q1', 'q2', 'q3', 'q4'];
        //标准差 数组
        $var_arr = [];
        foreach ($parm as $key) {

            $tem = array_column($a, $key);
            $avg = self::getAvg($tem);
            $var = self::getVariance($avg, $tem);
            $var_arr[] = $var;

        }

        return array_sum($var_arr);
    }

    /**
     * 计算这个房间的 标准差  之和
     * a为 房间总数组
     * @param $a
     * @return number
     */
    private static function doThisRoomRes($a)
    {

        $parm = ['q1', 'q2', 'q3', 'q4'];

        $var_arr = [];

        foreach ($parm as $key) {

            $tem = array_column($a, $key);
            $avg = self::getAvg($tem);
            $var = self::getVariance($avg, $tem);
            $var_arr[] = $var;

        }

        return array_sum($var_arr);
    }

    /**
     * 数组取平均
     * @param $a
     * @return float
     */
    private static function getAvg($a)
    {

        return array_sum($a) / count($a);
    }

    /**
     * 数组取标准差
     * @param $avg
     * @param $list
     * @return bool|float
     */
    private static function getVariance($avg, $list)
    {
        $arrayCount = count($list);
        if ($arrayCount == 1) {
            return FALSE;
        } elseif ($arrayCount > 0) {
            $total_var = 0;
            foreach ($list as $lv) {
                $total_var += pow(($lv - $avg), 2);
            }
            return sqrt($total_var / (count($list) - 1));
        } else
            return FALSE;
    }

}

//运行
DD::run();
    
