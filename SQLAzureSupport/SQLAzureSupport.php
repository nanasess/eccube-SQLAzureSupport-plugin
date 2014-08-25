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
        $arrDataFiles = array(
            'data/class/db/SC_DB_DBFactory.php',
            'data/class/db/dbfactory/SC_DB_DBFactory_SQLSRV.php',
            'data/class/helper/SC_Helper_Mail.php',
            'data/class/helper/SC_Helper_Purchase.php',
            'data/class/pages/admin/basis/LC_Page_Admin_Basis_ZipInstall.php',
            'data/class_extends/SC_CustomerList_Ex.php',
            'data/class_extends/SC_Customer_Ex.php',
            'data/class_extends/SC_Product_Ex.php',
            'data/class_extends/SC_Query_Ex.php',
            'data/class_extends/SC_SelectSql_Ex.php',
            'data/class_extends/db_extends/SC_DB_DBFactory_Ex.php',
            'data/class_extends/db_extends/dbfactory/SC_DB_DBFactory_SQLSRV_Ex.php',
            'data/class_extends/helper_extends/SC_Helper_News_Ex.php',
            'data/class_extends/page_extends/admin/total/LC_Page_Admin_Total_Ex.php',
            'data/class_extends/page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_News_Ex.php',
            'data/class_extends/page_extends/mypage/LC_Page_Mypage_Favorite_Ex.php',
            'data/config/config.php',
            'data/module/MDB2/Driver/Datatype/sqlsrv.php',
            'data/module/MDB2/Driver/Function/sqlsrv.php',
            'data/module/MDB2/Driver/Manager/sqlsrv.php',
            'data/module/MDB2/Driver/Native/sqlsrv.php',
            'data/module/MDB2/Driver/Reverse/sqlsrv.php',
            'data/module/MDB2/Driver/sqlsrv.php');
        $arrHtmlFiles = array(
            'html/install/sql/create_table_sqlsrv.sql',
            'html/install/sql/insert_data_sqlsrv.sql',
            'html/install/index.php');

        $suffix = date('Ymd');
        $http_url = HTTP_URL;
        // ファイルが存在する場合はバックアップ取得し, ファイルコピー
        foreach ($arrDataFiles as $file) {
            if (file_exists(DATA_REALDIR . substr($file, 5))) {

                if (copy(DATA_REALDIR . substr($file, 5), DATA_REALDIR . substr($file, 5) . '.' . $suffix)) {
                    if (copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/files/' . $file, DATA_REALDIR . substr($file, 5)) === false);
                }
            } else {
                if (copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/files/' . $file, DATA_REALDIR . substr($file, 5)) === false);
            }
        }
        foreach ($arrHtmlFiles as $file) {
            if (file_exists(HTML_REALDIR . substr($file, 5))) {
                if (copy(HTML_REALDIR . substr($file, 5), HTML_REALDIR . substr($file, 5) . '.' . $suffix)) {
                    if (copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/files/' . $file, HTML_REALDIR . substr($file, 5)) === false);
                }
            } else {
                if (copy(PLUGIN_UPLOAD_REALDIR . AZURE_PLUGIN_NAME . '/files/' . $file, HTML_REALDIR . substr($file, 5)) === false);
            }
        }

        // インストーラファイルを削除
        copy(DATA_REALDIR . 'config/define.php', DATA_REALDIR . 'config/define.php' . '.' . $suffix);
        unlink(DATA_REALDIR . 'config/define.php');
        // config.php が上書きされているので強制リダイレクト
        header('Location: ' . $http_url . 'install/index.php');
    }

    function disable($arrPlugin) {
        // nop
    }
}
