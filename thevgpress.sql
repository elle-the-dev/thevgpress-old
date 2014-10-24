CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT,
    skin_id INT UNSIGNED NOT NULL DEFAULT 1,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(50) NOT NULL,
    reset_token VARCHAR(50) NULL,
    reset_time DATETIME NULL,
    email VARCHAR(253) NULL,
    signature TEXT NULL,
    profile TEXT NULL,
    comments_per_page TINYINT(3) UNSIGNED NOT NULL DEFAULT 20,
    bury_votes INT NOT NULL DEFAULT -5,
    sticky_menu TINYINT(1) NOT NULL DEFAULT 1,
    menu_dropdowns TINYINT(1) NOT NULL DEFAULT 1,
    use_editor TINYINT(1) NOT NULL DEFAULT 1,
    show_avatars TINYINT(1) NOT NULL DEFAULT 1,
    show_stats TINYINT(1) NOT NULL DEFAULT 1,
    show_signatures TINYINT(1) NOT NULL DEFAULT 1,
    hide_read TINYINT(1) NOT NULL DEFAULT 0,
    jump_last_unread TINYINT(1) DEFAULT 1,
    appear_online TINYINT(1) DEFAULT 1,
    country VARCHAR(2) NOT NULL DEFAULT 'UN',
    ip VARCHAR(15) NOT NULL DEFAULT '0.0.0.0',
    news_visited_at DATETIME NULL,
    score INT NOT NULL DEFAULT 0,
    news_clicks INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id),
    UNIQUE KEY (username)
);

CREATE TABLE comments (
    id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    external_id INT UNSIGNED NOT NULL,
    comment_type enum('news', 'review', 'blog', 'forum') NOT NULL,
    comment MEDIUMTEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE comment_stars (
    comment_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(comment_id, user_id)
);

CREATE TABLE forum_boards (
    id INT UNSIGNED AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE forum_topics (
    id INT UNSIGNED AUTO_INCREMENT,
    forum_board_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(100) NOT NULL,
    stickied TINYINT(1) NOT NULL DEFAULT 0,
    locked TINYINT(1) NOT NULL DEFAULT 0,
    votes INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE forum_topics_read (
    id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    forum_topic_id INT UNSIGNED NOT NULL,
    views INT UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE friends (
    user_id INT UNSIGNED NOT NULL,
    friend_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(user_id, friend_id)
);

CREATE TABLE messages (
    id INT UNSIGNED AUTO_INCREMENT,
    user_id_sender INT UNSIGNED NOT NULL,
    user_id_receiver INT UNSIGNED NOT NULL,
    title VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    sender_deleted_at DATETIME NULL,
    receiver_deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE news (
    id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NULL,
    link VARCHAR(2048),
    company TINYINT(1) NOT NULL DEFAULT 0,
    is_big_news TINYINT(1) NOT NULL DEFAULT 0,
    is_news TINYINT(1) NOT NULL DEFAULT 0,
    is_media TINYINT(1) NOT NULL DEFAULT 0,
    is_editorial TINYINT(1) NOT NULL DEFAULT 0,
    clicks INT UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE skins (
    id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NULL,
    name VARCHAR(20) NOT NULL,
    font_size_1 DECIMAL(3,2) NOT NULL,
    font_family_1 VARCHAR(255) NOT NULL,
    font_size_forum DECIMAL(3,2) NOT NULL,
    font_color_1 VARCHAR(6) NOT NULL,
    font_color_2 VARCHAR(6) NOT NULL,
    font_color_3 VARCHAR(6) NOT NULL,
    font_color_4 VARCHAR(6) NOT NULL,
    font_color_5 VARCHAR(6) NOT NULL,
    font_color_6 VARCHAR(6) NOT NULL,
    bg_color_1 VARCHAR(6) NOT NULL,
    bg_color_2 VARCHAR(6) NOT NULL,
    bg_color_3 VARCHAR(6) NOT NULL,
    bg_color_4 VARCHAR(6) NOT NULL,
    bg_color_5 VARCHAR(6) NOT NULL,
    bg_color_6 VARCHAR(6) NOT NULL,
    forum_sidebar_bg VARCHAR(6) NOT NULL,
    microsoft_bg VARCHAR(6) NOT NULL,
    microsoft_border VARCHAR(6) NOT NULL,
    nintendo_bg VARCHAR(6) NOT NULL,
    nintendo_border VARCHAR(6) NOT NULL,
    pc_bg VARCHAR(6) NOT NULL,
    pc_border VARCHAR(6) NOT NULL,
    sony_bg VARCHAR(6) NOT NULL,
    sony_border VARCHAR(6) NOT NULL,
    big_news_bg VARCHAR(6) NOT NULL,
    main_bg_image VARCHAR(1024) NOT NULL,
    sidebar_bg VARCHAR(6) NOT NULL,
    user_css TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE user_votes (
    id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    comment_id INT UNSIGNED NOT NULL,
    vote TINYINT(1) NOT NULL DEFAULT 0,
    is_hidden TINYINT(1) NOT NULL DEFAULT 0,
    is_starred TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE groups (
    id INT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE powers (
    id INT UNSIGNED AUTO_INCREMENT,
    `key` VARCHAR(20) NOT NULL,
    name VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY(id)
);

CREATE TABLE group_user (
    group_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(group_id, user_id)
);

CREATE TABLE group_power (
    group_id INT UNSIGNED NOT NULL,
    power_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(group_id, power_id)
);
