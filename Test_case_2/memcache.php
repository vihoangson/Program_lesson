<?php 
// Định nghĩa thông tin kết nối
// define('MEMCACHED_HOST', '10.11.8.118');
// define('MEMCACHED_PORT', '11211');

// Định nghĩa thông tin kết nối
define('MEMCACHED_HOST', '10.11.8.118');
define('MEMCACHED_PORT', '11211');
 
// Khỏi tạo kết nối memcache
$memcache = new Memcache;
$cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);
var_dump($cacheAvailable);
//$memcache->set("product",array(123,14,1,24,12,54,12,5,12,34,12,3,12,3,12,3,));
var_dump($memcache->get("product"));
die;

// Khởi tạo biến $product = null
$product = null;
 
// Đầu tiên,kiểm tra dữ liệu có tồn tại trong cache của chúng ta hay không ?
// Kiểm tra biến $cacheAvailable đã được khởi tạo ở mục 1 có thành công không (true), ngược lại là (false) 
if ($cacheAvailable == true)
{
    // Sử dụng key để lấy value là thông tin của product
    $key = 'product_' . $id;
 
    // Lấy thông tin product thông qua key
    $product = $memcache->get($key);
}
 
// Nếu biến product bằng null thì lúc này chúng ta mới lấy dữ liệu từ db
if (!$product)
{
    //Đọc dữ liệu từ db
    $sql = "SELECT id, name, description, price FROM products WHERE id = " . $id;
    $queryResource = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($queryResource);
}
?>