<?php
define('AZURE_PLUGIN_NAME', 'SQLAzureSupport');
/**
 * SQL Azure 対応プラグイン
 *
 * @author Kentaro Ohkouchi
 */
class SQLAzureSupport extends SC_Plugin_Base {

    /**
     * コンストラクタ.
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }


    function install($arrPlugin) {
        if(copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/logo.png', PLUGIN_HTML_REALDIR . AZURE_PLUGIN_NAME . '/logo.png') === false);
    }

    function uninstall($arrPlugin) {
        // unsupported.
    }


    function enable($arrPlugin) {
        $arrDataFiles = array('data/class_extends/page_extends/products/LC_Page_Products_List_Ex.php',
                              'data/class_extends/page_extends/admin/total/LC_Page_Admin_Total_Ex.php',
                              'data/class_extends/page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_News_Ex.php',
                              'data/class_extends/SC_Query_Ex.php',
                              'data/class_extends/helper_extends/SC_Helper_DB_Ex.php',
                              'data/class_extends/db_extends/SC_DB_DBFactory_Ex.php',
                              'data/class_extends/db_extends/dbfactory/SC_DB_DBFactory_SQLSRV_Ex.php',
                              'data/class_extends/SC_Customer_Ex.php',
                              'data/class_extends/SC_Product_Ex.php',
                              'data/module/MDB2.php',
                              'data/module/MDB2/Extended.php',
                              'data/module/MDB2/Driver/Manager/Common.php',
                              'data/module/MDB2/Driver/Manager/sqlsrv.php',
                              'data/module/MDB2/Driver/Reverse/Common.php',
                              'data/module/MDB2/Driver/Reverse/sqlsrv.php',
                              'data/module/MDB2/Driver/Datatype/Common.php',
                              'data/module/MDB2/Driver/Datatype/sqlsrv.php',
                              'data/module/MDB2/Driver/sqlsrv.php',
                              'data/module/MDB2/Driver/Function/Common.php',
                              'data/module/MDB2/Driver/Function/sqlsrv.php',
                              'data/module/MDB2/Driver/Native/Common.php',
                              'data/module/MDB2/Driver/Native/sqlsrv.php',
                              'data/module/MDB2/Iterator.php',
                              'data/module/MDB2/LOB.php',
                              'data/module/MDB2/Date.php',
                              'data/class/db/SC_DB_DBFactory.php',
                              'data/class/db/dbfactory/SC_DB_DBFactory_SQLSRV.php'
                              );
        $arrHtmlFiles = array('html/install/sql/create_table_sqlsrv.sql',
                              'html/install/sql/insert_data_sqlsrv.sql',
                              'html/install/index.php');

        foreach ($arrDataFiles as $file) {
            if (copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/files/' . $file, DATA_REALDIR . substr($file, 5)) === false);
        }
        foreach ($arrHtmlFiles as $file) {
            if (copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/files/' . $file, HTML_REALDIR . substr($file, 5)) === false);
        }
    }

    function disable($arrPlugin) {
        // nop
    }
}
