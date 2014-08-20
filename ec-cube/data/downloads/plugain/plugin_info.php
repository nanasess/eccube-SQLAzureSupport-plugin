<?php
/**
 * プラグイン の情報クラス.
 *
 * @package SQLAzureSupport
 * @author Kentaro Ohkouchi
 * @version $Id: $
 */
class plugin_info{
    /** プラグインコード(必須)：プラグインを識別する為キーで、他のプラグインと重複しない一意な値である必要があります. */
    static $PLUGIN_CODE       = "SQLAzureSupport";
    /** プラグイン名(必須)：EC-CUBE上で表示されるプラグイン名. */
    static $PLUGIN_NAME       = "Microsoft Windows Azure プラグイン";
    /** プラグインバージョン(必須)：プラグインのバージョン. */
    static $PLUGIN_VERSION    = "1.0";
    /** 対応バージョン(必須)：対応するEC-CUBEバージョン. */
    static $COMPLIANT_VERSION = "2.12.0";
    /** 作者(必須)：プラグイン作者. */
    static $AUTHOR            = "Kentaro Ohkouchi (Loop AZ)";
    /** 説明(必須)：プラグインの説明. */
    static $DESCRIPTION       = "Microsoft Windows Azure 対応プラグインです。インストーラのデータベースに SQL Azure が追加されます。PHP 5.3.0 以降対応。sqlsrv ドライバが必要です。";
    /** プラグインURL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $PLUGIN_SITE_URL   = "";
    /** プラグイン作者URL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $AUTHOR_SITE_URL   = "http://www.loop-az.co.jp/";
    /** クラス名(必須)：プラグインのクラス（拡張子は含まない） */
    static $CLASS_NAME        = "SQLAzureSupport";
    /** フックポイント：フックポイントとコールバック関数を定義します */
    static $HOOK_POINTS       = array();
    /** プラグインのライセンス. */
    static $LICENSE           = "GPL";
}
?>
