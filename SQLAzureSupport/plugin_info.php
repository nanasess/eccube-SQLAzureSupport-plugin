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
    static $PLUGIN_NAME       = "Microsoft SQL Database プラグイン";
    /** プラグインバージョン(必須)：プラグインのバージョン. */
    static $PLUGIN_VERSION    = "2.0";
    /** 対応バージョン(必須)：対応するEC-CUBEバージョン. */
    static $COMPLIANT_VERSION = "2.13.2";
    /** 作者(必須)：プラグイン作者. */
    static $AUTHOR            = "Kentaro Ohkouchi (Loop AZ)";
    /** 説明(必須)：プラグインの説明. */
    static $DESCRIPTION       = "Microsoft SQL Database 対応プラグインです。インストーラのデータベースに SQL Database が追加されます。PHP 5.3.0 以降対応、PHP5.4.x 推奨です。sqlsrv ドライバが必要です。プラグインを有効化すると、サイトが初期化され、インストール画面に遷移しますのでご注意ください。";
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
