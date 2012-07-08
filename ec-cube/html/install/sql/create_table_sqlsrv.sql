create table dtb_module_update_logs(
    log_id int NOT NULL,
    module_id int NOT NULL,
    buckup_path nvarchar(max),
    error_flg smallint DEFAULT 0,
    error nvarchar(max),
    ok nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (log_id)
);

CREATE TABLE dtb_ownersstore_settings (
    public_key varchar(64)
    PRIMARY KEY(public_key)
);

CREATE TABLE dtb_kiyaku (
    kiyaku_id int NOT NULL,
    kiyaku_title nvarchar(max) NOT NULL,
    kiyaku_text nvarchar(max) NOT NULL,
    rank int NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (kiyaku_id)
);

CREATE TABLE dtb_holiday (
    holiday_id int NOT NULL,
    title nvarchar(max) NOT NULL,
    month smallint NOT NULL,
    day smallint NOT NULL,
    rank int NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (holiday_id)
);

CREATE TABLE mtb_zip (
    id int,
    zipcode nvarchar(max),
    state nvarchar(max),
    city nvarchar(max),
    town nvarchar(max),
    PRIMARY KEY(id)
);

CREATE TABLE dtb_update (
    module_id int NOT NULL,
    module_name nvarchar(max) NOT NULL,
    now_version nvarchar(max),
    latest_version nvarchar(max) NOT NULL,
    module_explain nvarchar(max),
    main_php nvarchar(max) NOT NULL,
    extern_php nvarchar(max) NOT NULL,
    install_sql nvarchar(max),
    uninstall_sql nvarchar(max),
    other_files nvarchar(max),
    del_flg smallint NOT NULL DEFAULT 0,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    release_date datetimeoffset NOT NULL,
    PRIMARY KEY (module_id)
);

CREATE TABLE dtb_baseinfo (
    id smallint,
    company_name nvarchar(max),
    company_kana nvarchar(max),
    zip01 nvarchar(max),
    zip02 nvarchar(max),
    pref smallint,
    addr01 nvarchar(max),
    addr02 nvarchar(max),
    tel01 nvarchar(max),
    tel02 nvarchar(max),
    tel03 nvarchar(max),
    fax01 nvarchar(max),
    fax02 nvarchar(max),
    fax03 nvarchar(max),
    business_hour nvarchar(max),
    law_company nvarchar(max),
    law_manager nvarchar(max),
    law_zip01 nvarchar(max),
    law_zip02 nvarchar(max),
    law_pref smallint,
    law_addr01 nvarchar(max),
    law_addr02 nvarchar(max),
    law_tel01 nvarchar(max),
    law_tel02 nvarchar(max),
    law_tel03 nvarchar(max),
    law_fax01 nvarchar(max),
    law_fax02 nvarchar(max),
    law_fax03 nvarchar(max),
    law_email nvarchar(max),
    law_url nvarchar(max),
    law_term01 nvarchar(max),
    law_term02 nvarchar(max),
    law_term03 nvarchar(max),
    law_term04 nvarchar(max),
    law_term05 nvarchar(max),
    law_term06 nvarchar(max),
    law_term07 nvarchar(max),
    law_term08 nvarchar(max),
    law_term09 nvarchar(max),
    law_term10 nvarchar(max),
    tax numeric(9) NOT NULL DEFAULT 5,
    tax_rule smallint NOT NULL DEFAULT 1,
    email01 nvarchar(max),
    email02 nvarchar(max),
    email03 nvarchar(max),
    email04 nvarchar(max),
    email05 nvarchar(max),
    free_rule numeric(9),
    shop_name nvarchar(max),
    shop_kana nvarchar(max),
    shop_name_eng nvarchar(max),
    point_rate numeric(9) NOT NULL DEFAULT 0,
    welcome_point numeric(9) NOT NULL DEFAULT 0,
    update_date datetimeoffset NOT NULL,
    top_tpl nvarchar(max),
    product_tpl nvarchar(max),
    detail_tpl nvarchar(max),
    mypage_tpl nvarchar(max),
    good_traded nvarchar(max),
    message nvarchar(max),
    regular_holiday_ids nvarchar(max),
    latitude nvarchar(max),
    longitude nvarchar(max),
    downloadable_days numeric(9) DEFAULT 30,
    downloadable_days_unlimited smallint,
    PRIMARY KEY(id)
);

CREATE TABLE dtb_deliv (
    deliv_id int NOT NULL,
    product_type_id int,
    name nvarchar(max),
    service_name nvarchar(max),
    remark nvarchar(max),
    confirm_url nvarchar(max),
    rank int,
    status smallint NOT NULL DEFAULT 1,
    del_flg smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (deliv_id)
);

CREATE TABLE dtb_payment_options (
    deliv_id int NOT NULL,
    payment_id int NOT NULL,
    rank int,
    PRIMARY KEY (deliv_id, payment_id)
);

CREATE TABLE dtb_delivtime (
    deliv_id int NOT NULL,
    time_id int NOT NULL,
    deliv_time nvarchar(max) NOT NULL,
    PRIMARY KEY (deliv_id, time_id)
);

CREATE TABLE dtb_delivfee (
    deliv_id int NOT NULL,
    fee_id int NOT NULL,
    fee numeric(9) NOT NULL,
    pref smallint,
    PRIMARY KEY (deliv_id, fee_id)
);

CREATE TABLE dtb_payment (
    payment_id int NOT NULL,
    payment_method nvarchar(max),
    charge numeric(9),
    rule_max numeric(9),
    rank int,
    note nvarchar(max),
    fix smallint,
    status smallint NOT NULL DEFAULT 1,
    del_flg smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    payment_image nvarchar(max),
    upper_rule numeric(9),
    charge_flg smallint DEFAULT 1,
    rule_min numeric(9),
    upper_rule_max numeric(9),
    module_id int,
    module_path nvarchar(max),
    memo01 nvarchar(max),
    memo02 nvarchar(max),
    memo03 nvarchar(max),
    memo04 nvarchar(max),
    memo05 nvarchar(max),
    memo06 nvarchar(max),
    memo07 nvarchar(max),
    memo08 nvarchar(max),
    memo09 nvarchar(max),
    memo10 nvarchar(max),
    PRIMARY KEY (payment_id)
);

CREATE TABLE dtb_mailtemplate (
    template_id int NOT NULL,
    subject nvarchar(max),
    header nvarchar(max),
    footer nvarchar(max),
    creator_id int NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (template_id)
);

CREATE TABLE dtb_mailmaga_template (
    template_id int NOT NULL,
    subject nvarchar(max),
    mail_method int,
    body nvarchar(max),
    del_flg smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (template_id)
);

CREATE TABLE dtb_send_history (
    send_id int NOT NULL,
    mail_method smallint,
    subject nvarchar(max),
    body nvarchar(max),
    send_count int,
    complete_count int NOT NULL DEFAULT 0,
    start_date datetimeoffset,
    end_date datetimeoffset,
    search_data nvarchar(max),
    del_flg smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (send_id)
);

CREATE TABLE dtb_send_customer (
    customer_id int NOT NULL,
    send_id int NOT NULL,
    email nvarchar(max),
    name nvarchar(max),
    send_flag smallint,
    PRIMARY KEY (send_id, customer_id)
);

CREATE TABLE dtb_products (
    product_id int NOT NULL,
    name nvarchar(max) NOT NULL,
    maker_id int,
    status smallint NOT NULL DEFAULT 2,
    comment1 nvarchar(max),
    comment2 nvarchar(max),
    comment3 nvarchar(max),
    comment4 nvarchar(max),
    comment5 nvarchar(max),
    comment6 nvarchar(max),
    note nvarchar(max),
    main_list_comment nvarchar(max),
    main_list_image nvarchar(max),
    main_comment nvarchar(max),
    main_image nvarchar(max),
    main_large_image nvarchar(max),
    sub_title1 nvarchar(max),
    sub_comment1 nvarchar(max),
    sub_image1 nvarchar(max),
    sub_large_image1 nvarchar(max),
    sub_title2 nvarchar(max),
    sub_comment2 nvarchar(max),
    sub_image2 nvarchar(max),
    sub_large_image2 nvarchar(max),
    sub_title3 nvarchar(max),
    sub_comment3 nvarchar(max),
    sub_image3 nvarchar(max),
    sub_large_image3 nvarchar(max),
    sub_title4 nvarchar(max),
    sub_comment4 nvarchar(max),
    sub_image4 nvarchar(max),
    sub_large_image4 nvarchar(max),
    sub_title5 nvarchar(max),
    sub_comment5 nvarchar(max),
    sub_image5 nvarchar(max),
    sub_large_image5 nvarchar(max),
    sub_title6 nvarchar(max),
    sub_comment6 nvarchar(max),
    sub_image6 nvarchar(max),
    sub_large_image6 nvarchar(max),
    del_flg smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    deliv_date_id int,
    PRIMARY KEY (product_id)
);

CREATE TABLE dtb_products_class (
    product_class_id int NOT NULL,
    product_id int NOT NULL,
    classcategory_id1 int NOT NULL DEFAULT 0,
    classcategory_id2 int NOT NULL DEFAULT 0,
    product_type_id int NOT NULL DEFAULT 0,
    product_code nvarchar(max),
    stock numeric(9),
    stock_unlimited smallint NOT NULL DEFAULT 0,
    sale_limit numeric(9),
    price01 numeric(9),
    price02 numeric(9) NOT NULL,
    deliv_fee numeric(9),
    point_rate numeric(9) NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    down_filename nvarchar(max),
    down_realfilename nvarchar(max),
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (product_class_id),
    UNIQUE (product_id, classcategory_id1, classcategory_id2)
);

CREATE TABLE dtb_class (
    class_id int NOT NULL,
    name nvarchar(max),
    rank int,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (class_id)
);

CREATE TABLE dtb_classcategory (
    classcategory_id int NOT NULL,
    name nvarchar(max),
    class_id int NOT NULL,
    rank int,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (classcategory_id)
);

CREATE TABLE dtb_category (
    category_id int NOT NULL,
    category_name nvarchar(max),
    parent_category_id int NOT NULL DEFAULT 0,
    level int NOT NULL,
    rank int,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (category_id)
);

CREATE TABLE dtb_product_categories (
    product_id int NOT NULL,
    category_id int NOT NULL,
    rank int NOT NULL,
    PRIMARY KEY(product_id, category_id)
);

CREATE TABLE dtb_product_status (
    product_status_id smallint NOT NULL,
    product_id int NOT NULL,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (product_status_id, product_id)
);

CREATE TABLE dtb_recommend_products (
    product_id int NOT NULL,
    recommend_product_id int NOT NULL,
    rank int NOT NULL,
    comment nvarchar(max),
    status smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY(product_id, recommend_product_id)
);

CREATE TABLE dtb_review (
    review_id int NOT NULL,
    product_id int NOT NULL,
    reviewer_name nvarchar(max) NOT NULL,
    reviewer_url nvarchar(max),
    sex smallint,
    customer_id int,
    recommend_level smallint NOT NULL,
    title nvarchar(max) NOT NULL,
    comment nvarchar(max) NOT NULL,
    status smallint DEFAULT 2,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (review_id)
);

CREATE TABLE dtb_customer_favorite_products (
    customer_id int NOT NULL,
    product_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (customer_id, product_id)
);

CREATE TABLE dtb_category_count (
    category_id int NOT NULL,
    product_count int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (category_id)
);

CREATE TABLE dtb_category_total_count (
    category_id int NOT NULL,
    product_count int,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (category_id)
);

CREATE TABLE dtb_news (
    news_id int NOT NULL,
    news_date datetimeoffset,
    rank int,
    news_title nvarchar(max) NOT NULL,
    news_comment nvarchar(max),
    news_url nvarchar(max),
    news_select smallint NOT NULL DEFAULT 0,
    link_method nvarchar(max),
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (news_id)
);

CREATE TABLE dtb_best_products (
    best_id int NOT NULL,
    category_id int NOT NULL,
    rank int NOT NULL DEFAULT 0,
    product_id int NOT NULL,
    title nvarchar(max),
    comment nvarchar(max),
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (best_id)
);

CREATE TABLE dtb_mail_history (
    send_id int NOT NULL,
    order_id int NOT NULL,
    send_date datetimeoffset,
    template_id int,
    creator_id int NOT NULL,
    subject nvarchar(max),
    mail_body nvarchar(max),
    PRIMARY KEY (send_id)
);

CREATE TABLE dtb_customer (
    customer_id int NOT NULL,
    name01 nvarchar(max) NOT NULL,
    name02 nvarchar(max) NOT NULL,
    kana01 nvarchar(max) NOT NULL,
    kana02 nvarchar(max) NOT NULL,
    zip01 nvarchar(max),
    zip02 nvarchar(max),
    pref smallint,
    addr01 nvarchar(max),
    addr02 nvarchar(max),
    email nvarchar(max) NOT NULL,
    email_mobile nvarchar(max),
    tel01 nvarchar(max),
    tel02 nvarchar(max),
    tel03 nvarchar(max),
    fax01 nvarchar(max),
    fax02 nvarchar(max),
    fax03 nvarchar(max),
    sex smallint,
    job smallint,
    birth datetimeoffset,
    password nvarchar(max),
    reminder smallint,
    reminder_answer nvarchar(max),
    salt nvarchar(max),
    secret_key varchar(64) NOT NULL,
    first_buy_date datetimeoffset,
    last_buy_date datetimeoffset,
    buy_times numeric(9) DEFAULT 0,
    buy_total numeric(9) DEFAULT 0,
    point numeric(9) NOT NULL DEFAULT 0,
    note nvarchar(max),
    status smallint NOT NULL DEFAULT 1,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    mobile_phone_id nvarchar(max),
    mailmaga_flg smallint,
    PRIMARY KEY (customer_id),
    UNIQUE (secret_key)
);

CREATE TABLE dtb_order (
    order_id int NOT NULL,
    order_temp_id nvarchar(max),
    customer_id int NOT NULL,
    message nvarchar(max),
    order_name01 nvarchar(max),
    order_name02 nvarchar(max),
    order_kana01 nvarchar(max),
    order_kana02 nvarchar(max),
    order_email nvarchar(max),
    order_tel01 nvarchar(max),
    order_tel02 nvarchar(max),
    order_tel03 nvarchar(max),
    order_fax01 nvarchar(max),
    order_fax02 nvarchar(max),
    order_fax03 nvarchar(max),
    order_zip01 nvarchar(max),
    order_zip02 nvarchar(max),
    order_pref smallint,
    order_addr01 nvarchar(max),
    order_addr02 nvarchar(max),
    order_sex smallint,
    order_birth datetimeoffset,
    order_job int,
    subtotal numeric(9),
    discount numeric(9) NOT NULL DEFAULT 0,
    deliv_id int,
    deliv_fee numeric(9),
    charge numeric(9),
    use_point numeric(9) NOT NULL DEFAULT 0,
    add_point numeric(9) NOT NULL DEFAULT 0,
    birth_point numeric(9) NOT NULL DEFAULT 0,
    tax numeric(9),
    total numeric(9),
    payment_total numeric(9),
    payment_id int,
    payment_method nvarchar(max),
    note nvarchar(max),
    status smallint,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    commit_date datetimeoffset,
    payment_date datetimeoffset,
    device_type_id int,
    del_flg smallint NOT NULL DEFAULT 0,
    memo01 nvarchar(max),
    memo02 nvarchar(max),
    memo03 nvarchar(max),
    memo04 nvarchar(max),
    memo05 nvarchar(max),
    memo06 nvarchar(max),
    memo07 nvarchar(max),
    memo08 nvarchar(max),
    memo09 nvarchar(max),
    memo10 nvarchar(max),
    PRIMARY KEY (order_id)
);

CREATE TABLE dtb_order_temp (
    order_temp_id varchar(32) NOT NULL,
    customer_id int NOT NULL,
    message nvarchar(max),
    order_name01 nvarchar(max),
    order_name02 nvarchar(max),
    order_kana01 nvarchar(max),
    order_kana02 nvarchar(max),
    order_email nvarchar(max),
    order_tel01 nvarchar(max),
    order_tel02 nvarchar(max),
    order_tel03 nvarchar(max),
    order_fax01 nvarchar(max),
    order_fax02 nvarchar(max),
    order_fax03 nvarchar(max),
    order_zip01 nvarchar(max),
    order_zip02 nvarchar(max),
    order_pref smallint,
    order_addr01 nvarchar(max),
    order_addr02 nvarchar(max),
    order_sex smallint,
    order_birth datetimeoffset,
    order_job int,
    subtotal numeric(9),
    discount numeric(9) NOT NULL DEFAULT 0,
    deliv_id int,
    deliv_fee numeric(9),
    charge numeric(9),
    use_point numeric(9) NOT NULL DEFAULT 0,
    add_point numeric(9) NOT NULL DEFAULT 0,
    birth_point numeric(9) NOT NULL DEFAULT 0,
    tax numeric(9),
    total numeric(9),
    payment_total numeric(9),
    payment_id int,
    payment_method nvarchar(max),
    note nvarchar(max),
    mail_flag smallint,
    status smallint,
    deliv_check smallint,
    point_check smallint,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    device_type_id int,
    del_flg smallint NOT NULL DEFAULT 0,
    order_id int,
    memo01 nvarchar(max),
    memo02 nvarchar(max),
    memo03 nvarchar(max),
    memo04 nvarchar(max),
    memo05 nvarchar(max),
    memo06 nvarchar(max),
    memo07 nvarchar(max),
    memo08 nvarchar(max),
    memo09 nvarchar(max),
    memo10 nvarchar(max),
    session nvarchar(max),
    PRIMARY KEY (order_temp_id)
);

CREATE TABLE dtb_shipping (
    shipping_id int NOT NULL,
    order_id int NOT NULL,
    shipping_name01 nvarchar(max),
    shipping_name02 nvarchar(max),
    shipping_kana01 nvarchar(max),
    shipping_kana02 nvarchar(max),
    shipping_tel01 nvarchar(max),
    shipping_tel02 nvarchar(max),
    shipping_tel03 nvarchar(max),
    shipping_fax01 nvarchar(max),
    shipping_fax02 nvarchar(max),
    shipping_fax03 nvarchar(max),
    shipping_pref smallint,
    shipping_zip01 nvarchar(max),
    shipping_zip02 nvarchar(max),
    shipping_addr01 nvarchar(max),
    shipping_addr02 nvarchar(max),
    time_id int,
    shipping_time nvarchar(max),
    shipping_num nvarchar(max),
    shipping_date datetimeoffset,
    shipping_commit_date datetimeoffset,
    rank int,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (shipping_id, order_id)
);

CREATE TABLE dtb_shipment_item (
    shipping_id int NOT NULL,
    product_class_id int NOT NULL,
    order_id int NOT NULL,
    product_name nvarchar(max) NOT NULL,
    product_code nvarchar(max),
    classcategory_name1 nvarchar(max),
    classcategory_name2 nvarchar(max),
    price numeric(9),
    quantity numeric(9),
    PRIMARY KEY (shipping_id, product_class_id, order_id)
);

CREATE TABLE dtb_other_deliv (
    other_deliv_id int NOT NULL,
    customer_id int NOT NULL,
    name01 nvarchar(max),
    name02 nvarchar(max),
    kana01 nvarchar(max),
    kana02 nvarchar(max),
    zip01 nvarchar(max),
    zip02 nvarchar(max),
    pref smallint,
    addr01 nvarchar(max),
    addr02 nvarchar(max),
    tel01 nvarchar(max),
    tel02 nvarchar(max),
    tel03 nvarchar(max),
    PRIMARY KEY (other_deliv_id)
);

CREATE TABLE dtb_order_detail (
    order_detail_id int NOT NULL,
    order_id int NOT NULL,
    product_id int NOT NULL,
    product_class_id int NOT NULL,
    product_name nvarchar(max) NOT NULL,
    product_code nvarchar(max),
    classcategory_name1 nvarchar(max),
    classcategory_name2 nvarchar(max),
    price numeric(9),
    quantity numeric(9),
    point_rate numeric(9) NOT NULL DEFAULT 0,
    PRIMARY KEY (order_detail_id)
);

CREATE TABLE dtb_member (
    member_id int NOT NULL,
    name nvarchar(max),
    department nvarchar(max),
    login_id nvarchar(max) NOT NULL,
    password nvarchar(max) NOT NULL,
    salt nvarchar(max) NOT NULL,
    authority smallint NOT NULL,
    rank int NOT NULL DEFAULT 0,
    work smallint NOT NULL DEFAULT 1,
    del_flg smallint NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    login_date datetimeoffset,
    PRIMARY KEY (member_id)
);

CREATE TABLE dtb_pagelayout (
    device_type_id int NOT NULL,
    page_id int NOT NULL,
    page_name nvarchar(max),
    url nvarchar(max) NOT NULL,
    filename nvarchar(max),
    header_chk smallint DEFAULT 1,
    footer_chk smallint DEFAULT 1,
    edit_flg smallint DEFAULT 1,
    author nvarchar(max),
    description nvarchar(max),
    keyword nvarchar(max),
    update_url nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (device_type_id, page_id)
);

CREATE TABLE dtb_bloc (
    device_type_id int NOT NULL,
    bloc_id int NOT NULL,
    bloc_name nvarchar(max),
    tpl_path nvarchar(max),
    filename varchar(64) NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    php_path nvarchar(max),
    deletable_flg smallint NOT NULL DEFAULT 1,
    plugin_id int,
    PRIMARY KEY (device_type_id, bloc_id),
    UNIQUE (device_type_id, filename)
);

CREATE TABLE dtb_blocposition (
    device_type_id int NOT NULL,
    page_id int NOT NULL,
    target_id int NOT NULL,
    bloc_id int NOT NULL,
    bloc_row int,
    anywhere smallint DEFAULT 0 NOT NULL,
    PRIMARY KEY (device_type_id, page_id, target_id, bloc_id)
);

CREATE TABLE dtb_csv (
    no int,
    csv_id int NOT NULL,
    col nvarchar(max),
    disp_name nvarchar(max),
    rank int,
    rw_flg smallint DEFAULT 1,
    status smallint NOT NULL DEFAULT 1,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    mb_convert_kana_option nvarchar(max),
    size_const_type nvarchar(max),
    error_check_types nvarchar(max),
    PRIMARY KEY (no)
);

CREATE TABLE dtb_csv_sql (
    sql_id int,
    sql_name nvarchar(max) NOT NULL,
    csv_sql nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (sql_id)
);

CREATE TABLE dtb_templates (
    template_code varchar(64) NOT NULL,
    device_type_id int NOT NULL,
    template_name nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (template_code)
);

CREATE TABLE dtb_maker (
    maker_id int NOT NULL,
    name nvarchar(max) NOT NULL,
    rank int NOT NULL DEFAULT 0,
    creator_id int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    del_flg smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (maker_id)
);

CREATE TABLE dtb_maker_count (
    maker_id int NOT NULL,
    product_count int NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (maker_id)
);

CREATE TABLE mtb_pref (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_permission (
    id varchar(64),
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_disable_logout (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_authority (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_auth_excludes (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_work (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_disp (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_status (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_status_image (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_allowed_tag (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_page_max (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_magazine_type (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_mail_magazine_type (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_recommend (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_taxrule (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_mail_template (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_mail_tpl_path (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_job (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_reminder (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_sex (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_customer_status (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_mail_type (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_order_status (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_product_status_color (
    id smallint,
    name varchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_customer_order_status (
    id smallint,
    name varchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_order_status_color (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_wday (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_delivery_date (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_product_list_max (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_db (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_target (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_review_deny_url (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_mobile_domain (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_ownersstore_err (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_ownersstore_ips (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_constants (
    id varchar(64),
    name nvarchar(max),
    rank smallint NOT NULL DEFAULT 0,
    remarks nvarchar(max),
    PRIMARY KEY (id)
);

CREATE TABLE mtb_product_type (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE mtb_device_type (
    id smallint,
    name nvarchar(max),
    rank smallint NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE dtb_mobile_ext_session_id (
    session_id varchar(64) NOT NULL,
    param_key nvarchar(max),
    param_value nvarchar(max),
    url nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (session_id)
);

CREATE TABLE dtb_module (
    module_id int NOT NULL UNIQUE,
    module_code nvarchar(max) NOT NULL,
    module_name nvarchar(max) NOT NULL,
    sub_data nvarchar(max),
    auto_update_flg smallint NOT NULL DEFAULT 0,
    del_flg smallint NOT NULL DEFAULT 0,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY(module_id)
);

CREATE TABLE dtb_session (
    sess_id varchar(64) NOT NULL,
    sess_data nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (sess_id)
);

CREATE TABLE dtb_bkup (
    bkup_name varchar(64),
    bkup_memo nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (bkup_name)
);

CREATE TABLE dtb_plugin (
    plugin_id int NOT NULL,
    plugin_name nvarchar(max) NOT NULL,
    plugin_code nvarchar(max) NOT NULL,
    class_name nvarchar(max) NOT NULL,
    author nvarchar(max),
    author_site_url nvarchar(max),
    plugin_site_url nvarchar(max),
    plugin_version nvarchar(max),
    compliant_version nvarchar(max),
    plugin_description nvarchar(max),
    priority int NOT NULL DEFAULT 0,
    enable smallint NOT NULL DEFAULT 0,
    free_field1 nvarchar(max),
    free_field2 nvarchar(max),
    free_field3 nvarchar(max),
    free_field4 nvarchar(max),
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (plugin_id)
);

CREATE TABLE dtb_plugin_hookpoint (
    plugin_hookpoint_id int NOT NULL,
    plugin_id int NOT NULL,
    hook_point nvarchar(max) NOT NULL,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (plugin_hookpoint_id)
);

CREATE TABLE dtb_index_list (
    table_name varchar(64) NOT NULL,
    column_name varchar(64) NOT NULL,
    recommend_flg smallint NOT NULL DEFAULT 0,
    recommend_comment nvarchar(max),
    PRIMARY KEY (table_name, column_name)
);

CREATE TABLE dtb_api_config (
    api_config_id int NOT NULL,
    operation_name nvarchar(max) NOT NULL,
    operation_description nvarchar(max),
    auth_types nvarchar(max) NOT NULL,
    enable smallint NOT NULL DEFAULT 0,
    is_log smallint NOT NULL DEFAULT 0,
    sub_data nvarchar(max),
    del_flg smallint NOT NULL DEFAULT 0,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (api_config_id)
);

CREATE TABLE dtb_api_account (
    api_account_id int NOT NULL,
    api_access_key nvarchar(max) NOT NULL,
    api_secret_key nvarchar(max) NOT NULL,
    enable smallint NOT NULL DEFAULT 0,
    del_flg smallint NOT NULL DEFAULT 0,
    create_date datetimeoffset NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_date datetimeoffset NOT NULL,
    PRIMARY KEY (api_account_id)
);
