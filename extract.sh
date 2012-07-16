#!/bin/sh
WRK_DIR=SQLAzureSupport
if [ ! -d $WRK_DIR ]; then
    mkdir $WRK_DIR
fi
cat << EOF | xargs tar cf tmp.tar
data/class/SC_Initial.php
data/class/SC_Product.php
data/class/SC_Query.php
data/class/SC_SelectSql.php
data/class/db/SC_DB_DBFactory.php
data/class/db/dbfactory/SC_DB_DBFactory_SQLSRV.php
data/class/pages/admin/LC_Page_Admin_Home.php
data/class/pages/admin/contents/LC_Page_Admin_Contents_Recommend.php
data/class/pages/admin/products/LC_Page_Admin_Products_ProductRank.php
data/class/pages/admin/system/LC_Page_Admin_System_Input.php
data/class/pages/frontparts/bloc/LC_Page_FrontParts_Bloc_Category.php
data/class/pages/products/LC_Page_Products_Detail.php
data/class_extends/SC_Customer_Ex.php
data/class_extends/SC_Product_Ex.php
data/class_extends/db_extends/SC_DB_DBFactory_Ex.php
data/class_extends/db_extends/dbfactory/SC_DB_DBFactory_SQLSRV_Ex.php
data/class_extends/helper_extends/SC_Helper_DB_Ex.php
data/class_extends/helper_extends/SC_Helper_Purchase_Ex.php
data/class_extends/helper_extends/SC_Helper_Session_Ex.php
data/class_extends/page_extends/admin/LC_Page_Admin_Home_Ex.php
data/class_extends/page_extends/admin/basis/LC_Page_Admin_Basis_Point_Ex.php
data/class_extends/page_extends/admin/basis/LC_Page_Admin_Basis_ZipInstall_Ex.php
data/class_extends/page_extends/admin/total/LC_Page_Admin_Total_Ex.php
data/class_extends/page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_News_Ex.php
data/class_extends/page_extends/products/LC_Page_Products_List_Ex.php
data/module/MDB2.php
data/module/MDB2/Date.php
data/module/MDB2/Driver/Datatype/Common.php
data/module/MDB2/Driver/Datatype/sqlsrv.php
data/module/MDB2/Driver/Function/Common.php
data/module/MDB2/Driver/Function/sqlsrv.php
data/module/MDB2/Driver/Manager/Common.php
data/module/MDB2/Driver/Manager/sqlsrv.php
data/module/MDB2/Driver/Native/Common.php
data/module/MDB2/Driver/Native/sqlsrv.php
data/module/MDB2/Driver/Reverse/Common.php
data/module/MDB2/Driver/Reverse/sqlsrv.php
data/module/MDB2/Driver/sqlsrv.php
data/module/MDB2/Extended.php
data/module/MDB2/Iterator.php
data/module/MDB2/LOB.php
data/downloads/plugin/SQLAzureSupport/SQLAzureSupport.php
data/downloads/plugin/SQLAzureSupport/logo.png
data/downloads/plugin/SQLAzureSupport/plugin_info.php
data/downloads/plugin/SQLAzureSupport/plugin_update.php
html/install/index.php
html/install/sql/create_table_sqlsrv.sql
html/install/sql/insert_data.sql
html/plugin/SQLAzureSupport/logo.png
EOF

mv tmp.tar $WRK_DIR/files
cd $WRK_DIR/files
tar xvf tmp.tar
rm tmp.tar
