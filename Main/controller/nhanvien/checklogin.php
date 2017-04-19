			    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
        if (!isset($_SESSION['tdn'])) {
            
            include '../../database/cnt.php';
            include '../../model/nhanvien.php';
            
            $tk = $_POST['txtTk'];
            $mk = $_POST['txtMk'];
            
            if (empty($tk))
                $errors[] = "Tên đăng nhập rỗng";
            
            $pttTk = '#^([a-zA-Z]|_)([a-zA-Z0-9]|_){2,100}#';
            if (! preg_match($pttTk, $tk)) {
                $errors[] = "Tên đăng nhập không đúng định dạng : a-zA-Z0-9,_ , 3-100 kí tự";
            }
            
            if (empty($mk))
                $errors[] = 'Mật khẩu rỗng';
            $pttMk = '#([a-zA-Z0-9]|_){3,100}#';
            if (! preg_match($pttMk, $mk)) {
                $errors[] = 'Mật khẩu không đúng định dạng : a-zA-Z0-9,_ , 3-100 kí tự';
            }
            try {
                if (empty($errors)) {
                    
                    $nvs = new nhanvien($db);
                    $rs = $nvs->dangnhap($tk, $mk);
                    if ($rs) {
                        $_SESSION['tdn'] = $tk;
                      
                        $errors = null;
                    } else {
                        $errors[] = 'Tên đăng nhập hoặc mật khẩu không chính xác !';
                    }
                }
            } catch (PDOException $e) {
                $errors[] = 'Lỗi : ' . $e->getMessage();
            }
            
            if ($errors == null) {
                $errors = array(
                    'er' => false,
                    "dt" => ''
                );
            } else {
                $errors = array(
                    'er' => true,
                    "dt" => $errors
                );
            }
        }else {
            $errors[]='Bạn đã đăng nhập';
            $errors = array(
                'er' => true,
                "dt" => $errors
            );
        }
            echo json_encode($errors);
        
    }
    
    ?>