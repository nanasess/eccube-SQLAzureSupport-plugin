#!/bin/sh
WRK_DIR=`pwd`/SQLAzureSupport
if [ ! -d $WRK_DIR ]; then
    mkdir $WRK_DIR
fi
if [ ! -d $WRK_DIR/files ]; then
    rm -rf $WRK_DIR/files
fi
if [ ! -f SQLAzureSupport.tar.gz ]; then
    rm -rf SQLAzureSupport.tar.gz
fi

cd ec-cube
cat << EOF | xargs tar cf tmp.tar
data/class/db/SC_DB_DBFactory.php
data/class/db/dbfactory/SC_DB_DBFactory_SQLSRV.php
data/class/helper/SC_Helper_Mail.php
data/class/helper/SC_Helper_Purchase.php
data/class/pages/admin/basis/LC_Page_Admin_Basis_ZipInstall.php
data/class_extends/SC_CustomerList_Ex.php
data/class_extends/SC_Customer_Ex.php
data/class_extends/SC_Product_Ex.php
data/class_extends/SC_Query_Ex.php
data/class_extends/SC_SelectSql_Ex.php
data/class_extends/db_extends/SC_DB_DBFactory_Ex.php
data/class_extends/db_extends/dbfactory/SC_DB_DBFactory_SQLSRV_Ex.php
data/class_extends/helper_extends/SC_Helper_News_Ex.php
data/class_extends/page_extends/admin/total/LC_Page_Admin_Total_Ex.php
data/class_extends/page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_News_Ex.php
data/class_extends/page_extends/mypage/LC_Page_Mypage_Favorite_Ex.php
data/config/config.php
data/module/MDB2/Driver/Datatype/sqlsrv.php
data/module/MDB2/Driver/Function/sqlsrv.php
data/module/MDB2/Driver/Manager/sqlsrv.php
data/module/MDB2/Driver/Native/sqlsrv.php
data/module/MDB2/Driver/Reverse/sqlsrv.php
data/module/MDB2/Driver/sqlsrv.php
html/install/index.php
html/install/sql/create_table_sqlsrv.sql
html/install/sql/insert_data.sql
EOF

mv tmp.tar $WRK_DIR/files
cd $WRK_DIR/files
tar xvf tmp.tar
rm tmp.tar
cd $WRK_DIR
tar vcfz ../SQLAzureSupport.tar.gz *
