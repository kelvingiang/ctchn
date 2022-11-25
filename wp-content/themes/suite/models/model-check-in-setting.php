<?php

class Admin_Model_Check_In_Setting{

    // ==================== IMPORT ==========================
    public function importMember($filename)
    {
        require_once(DIR_CLASS . 'PHPExcel.php');
        // Tien hanh xac thuc file
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        // Chi doc du lieu
        //$objReader->setReadDataOnly(true);

        // Load du lieu sang dang doi tuong
        $objReader->load("$filename");
        // Lay ra so trang
        $total_sheets = $objPHPExcel->getSheetCount();
        // Lay ra ten trang
        $allSheetName = $objPHPExcel->getSheetNames();
        // Chon trang can truy xuat
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        // Lay ra so dong cuoi cung
        $highestRow = $objWorksheet->getHighestRow();
        // Lay ra ten cot cuoi cung
        $highestColumn = $objWorksheet->getHighestColumn();
        // Chuyen doi ten cot ve vi tri thu, vi du C la 3, D la 4
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $arraydata = array();
        // Lap qua tung o du lieu
        // Dong dau tien la cot tieu de nen se lap gia tri tu dong 2
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                // Lay gia tri cua tung o de do vao mang
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arraydata[$row - 2][$col] = $value;
            }
        }
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        foreach($arraydata as $item) {
            $phone = $item[5] == null ? "" : $item[5];
            $email = $item[6] == null ? "" : $item[6];
            //data con thieu
            $data = array(
                '',
                '',
                'company_cn' => $item[2],
                'company_vn' => $item[3],
                'contact' => $item[4],
                'phone' => $phone,
                'email' => $email,
                'address_vn' => $item[7],
                'address_cn' => $item[8],
            );
            $wpdb->insert($table, $data);
        }
    }

    // =================== EXPORT ============================
    public function exportMember()
    {
        require_once(DIR_CLASS . 'PHPExcel.php');
        $exExport = new PHPExcel();

        // Tao cot title
        //cot tao con thieu
        $exExport->setActiveSheetIndex(0)
            ->setCellValue('A1', '')
            ->setCellValue('B1', '')
            ->setCellValue('C1', 'company_cn')
            ->setCellValue('D1', 'company_vn')
            ->setCellValue('E1', 'contact')
            ->setCellValue('F1', 'phone')
            ->setCellValue('G1', 'email')
            ->setCellValue('H1', 'address_vn')
            ->setCellValue('I1', 'address_cn');
        
        // Tao noi dung chen tu dong 2
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $sql = "SELECT * FROM $table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        if(!empty($row)) {
            $i = 2;
            foreach($row as $val){
                $exExport->setActiveSheetIndex(0)
                    ->setCellValueExplicit('A' . $i)
                    ->setCellValue('B' . $i)
                    ->setCellValue('C' . $i, $val['company_cn'])
                    ->setCellValue('D' . $i, $val['company_vn'])
                    ->setCellValue('E' . $i, $val['contact'])
                    ->setCellValue('F' . $i, $val['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('G' . $i, $val['email'])
                    ->setCellValue('H' . $i, $val['address_cn'])
                    ->setCellValue('I' . $i, $val['address_vn']);
                $i++;    
            }
        }

        // Tao file excel va save lai theo dang path 
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);

        // Tao file excel va down truc tiep xuong client 
        //$filename = date("YmdHis") . '_memberlist.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
        //ob_start();
        $objWriter->save('php://output');
    }
}