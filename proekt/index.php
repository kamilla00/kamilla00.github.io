<?php

session_start();

// Читаем ошибки и подсвечиваемые поля из cookies
$errors = isset($_COOKIE['errors']) ? json_decode($_COOKIE['errors'], true) : [];
$errorFields = isset($_COOKIE['error_fields']) ? json_decode($_COOKIE['error_fields'], true) : [];
$get = fn($key) => isset($_COOKIE[$key]) ? htmlspecialchars($_COOKIE[$key]) : '';

$username = $get('username'); 
// Вспомогатели для подстановки старых значений
$getArray = fn($key) => isset($_COOKIE[$key]) ? json_decode($_COOKIE[$key], true) : [];

// После чтения очищаем
setcookie('errors',     '', time() - 3600, '/');
setcookie('error_fields','', time() - 3600, '/');
setcookie('name',       '', time() - 3600, '/');
setcookie('phone',      '', time() - 3600, '/');
setcookie('email',      '', time() - 3600, '/');
setcookie('dob',        '', time() - 3600, '/');
setcookie('gender',     '', time() - 3600, '/');
setcookie('languages',  '', time() - 3600, '/');
setcookie('bio',        '', time() - 3600, '/');
setcookie('contract',   '', time() - 3600, '/');
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="Registr.js" defer></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Drupal-coder</title>
</head>

<body>
    <div class="navbar navbar-default" id="navbar">
        <div class="container" id="navbar-menu">
            <div class="region region-navigation">
                <a class="logo navbar-btn pull-left" href="#" title="Главная">
                    <img src="img/drupal-coder.svg" alt="Главная">
                </a>
            </div>
            <div class="navbar-collapse-wrapper">
                <div class="navbar-collapse collapse">
                    <div class="region region-navigation-collapsible">
                        <nav id="block-bootstrap-dc-main-menu">
                            <ul class="menu nav navbar-navigation">
                                <li>
                                    <a href="#">Поддержка Drupal</a>
                                </li>
                                <li class="expanded dropdown">
                                    <a href class="dropdown-toggle" data-toggle="dropdown" id="administration">Администрирование
<!--                                    <span class="caret"></span>-->
                                    </a>
                                    <div class="container-fluid dropdown-menu-wrapper">
                                        <ul class="menu dropdown-menu">
                                            <li> <a href="#"> Миграция </a> </li>
                                            <li> <a href="#"> Бэкапы </a> </li>
                                            <li> <a href="#"> Аудит безопасности </a></li>
                                            <li> <a href="#"> оптимизация скорости </a></li>
                                            <li> <a href="#"> Переезд на https</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">Продвижение</a>
                                </li>
                                <li>
                                    <a href="#">Реклама</a>
                                </li>
                                <li class="expanded dropdown">
                                    <a href class="dropdown-toggle" data-toggle="dropdown" id="aboutUs">О нас
<!--                                        <span class="caret"></span>-->
                                        </a>
                                    <div class="container-fluid dropdown-menu-wrapper">
                                        <ul class="menu dropdown-menu">
                                            <li> <a href="#">Команда </a></li>
                                            <li> <a href="#">Drupalgive </a></li>
                                            <li> <a href="#">Блог </a></li>
                                            <li> <a href="#">Курсы Drupal </a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">Проекты</a>
                                </li>
                                <li>
                                    <a href="#">Контакты</a>
                                </li>
                            </ul>

                        </nav>
                    </div>
                </div>

            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
        </div>
    </div>

    </header>
    <div class="overlay">

    </div>
    <div class="full-screen">
        <div class="region region-full-screen">
            <div class="block-main">
                <div class="block-main-bg">
                    <video playsinline autoplay="autoplay" loop class="fillWidth" preload="auto" muted>
                        <source src="img/video.mp4" type="video/mp4">Your browser does not support the video tag. I suggest you upgrade your browser.
                      </video>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="page-title">
                                Разработка <br> сайтов на Drupal
                            </h1>
                            <div class="suppor-main-description">
                                Сопровождение и поддержка сайтов <br> на CMS Drupal любых версий и запущенности
                            </div>
                            <div class="block-main-wrapper">
                                <a href="#" class="block-main-btn flowing-scroll"> Тарифы</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row support-achievements">
                                <div class="col-md-4 col-sm-4 col-xs-6 support-achievement">
                                    <div class="support-achievement-wrapper">
                                        <div class="support-achievement-title">
                                            #1 <img src="img/cup.png">
                                        </div>
                                        <div class="support-achievement-description">
                                            Drupal разработчик <br> В России по версии <br> Рейтинга Рунета
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 support-achievement">
                                    <div class="support-achievement-wrapper">
                                        <div class="support-achievement-title">
                                            3+
                                        </div>
                                        <div class="support-achievement-description">
                                            средний опыт<br> специалистов более <br> трех лет
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 support-achievement">
                                    <div class="support-achievement-wrapper">
                                        <div class="support-achievement-title">
                                            14
                                        </div>
                                        <div class="support-achievement-description">
                                            лет опыта в сфере <br> Drupal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 support-achievement">
                                    <div class="support-achievement-wrapper">
                                        <div class="support-achievement-title">
                                            50+
                                        </div>
                                        <div class="support-achievement-description">
                                            модулей и тем<br> в формате DrupalGive
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 support-achievement">
                                    <div class="support-achievement-wrapper">
                                        <div class="support-achievement-title">
                                            90 000+
                                        </div>
                                        <div class="support-achievement-description">
                                            часов поддержки <br>сайтов на Drupal
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 support-achievement">
                                    <div class="support-achievement-wrapper">
                                        <div class="support-achievement-title">
                                            300+
                                        </div>
                                        <div class="support-achievement-description">
                                            Проектов <br>на поддержке
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="region region-fw-content">
            <div class="content">
                <div class="competencies">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="block-title">
                                    13 лет совершенствуем <br> компетенции в Drupal <br> поддержке!
                                </h2>
                                <div class="competencies-description">
                                    Разрабатываем и оптимизируем модули, расширяем <br> функциональность сайтов, обновляем дизайн
                                </div>
                            </div>
                        </div>
                        <div class="row row-flex competencies-row">
                            <div class="col-sm-3 col-xs-6 col-6">

                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-1.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Добавление<br> информации на сайт,<br> создание новых<br> разделов
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-2.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Разработка <br> и оптимизация <br> модулей сайта
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-3.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Интеграция с CRM,<br> 1C, платежными<br> системами, любыми<br> веб-сервисами
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-4.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Любые доработки <br> функционала <br> и дизайна
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-5.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Аудит и мониторинг <br> безопасности Drupal <br> сайтов
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-6.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Миграция, импорт <br> контента и апгрейд <br> Drupal
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-7.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Оптимизация <br> и ускорение <br> Drupal сайтов
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 col-6">
                                <div class="competency">
                                    <div class="competency-wrapper">
                                        <div class="competency-header">
                                            <div class="competency-icon">
                                                <img src="img/competency-8.svg" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="competency-body">
                                            Веб-маркетинг, <br> консультации <br> и работы по SEO
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="advantages with-expertise">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="block-title">
                                    Разработка <br> от Drupal-coder
                                </h2>
                            </div>
                        </div>
                        <div class="row row-flex advantages-row">

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                01.
                                            </div>
                                            <div class="advantage-title">
                                                Поставновка задачи по Email
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Удобная и привычная постановка задач, при которой задачи фиксируются и никогда не теряются.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support1.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                02.
                                            </div>
                                            <div class="advantage-title">
                                                Система Helpdesk - отчетность, прозрачность
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Возможность посмотреть все заявки в работе и отработанные часы в личном кабинете через браузер.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support2.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                03.
                                            </div>
                                            <div class="advantage-title">
                                                Расширенная техническая поддержка
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Возможность организации расширенной технической поддержки с 6:00 до 22:00 без выходных
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support3.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                04.
                                            </div>
                                            <div class="advantage-title">
                                                Персональный менеджер проекта
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Ваш менеджер всегда вкурсе текущего состояния проекта и в любой момент готов ответить на любые вопросы.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support4.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                05.
                                            </div>
                                            <div class="advantage-title">
                                                Удобные способы оплаты
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Безналичный расчет по договору или электронные деньги: WebMoney, Яндекс.Деньги, PayPal.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support5.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                06.
                                            </div>
                                            <div class="advantage-title">
                                                работаем с SLA и NDA
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Работа в рамках соглашений конфеденциальности и об уровне качества работ.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support6.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                07.
                                            </div>
                                            <div class="advantage-title">
                                                Штатные специалисты
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Надежные штатные специалисты, никаких фрилансеров.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support7.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3 col-xs-12 advantage-col">
                                <div class="advantage">
                                    <div class="advantage-wrapper">
                                        <div class="advantage-header">
                                            <div class="advantage-num">
                                                08.
                                            </div>
                                            <div class="advantage-title">
                                                Удобные каналы связи
                                            </div>
                                        </div>
                                        <div class="advantage-body">
                                            Консультации по телефону, скайпу, мессенджерах.
                                        </div>
                                        <div class="advantage-icon">
                                            <img src="img/support8.svg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="expertise">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 col-md-offset-6" style="margin-left: 40%">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="block-title" style="color: white"> Экспертиза в Drupal, опыт 14 лет! </h2>
                                    </div>
                                </div>
                                <div class="row row-flex expertise-row">

                                    <div class="col-sm-6 col-xs-12 expertise-col">
                                        <div class="expertise-item">
                                            <div class="expertise-item-body">
                                                Только системный подход – контроль версий, резервирование и тестирование!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 expertise-col">
                                        <div class="expertise-item">
                                            <div class="expertise-item-body">
                                                Только Drupal сайты, не берем на поддержку сайты на других CMS!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 expertise-col">
                                        <div class="expertise-item">
                                            <div class="expertise-item-body">
                                                Участвуем в разработке ядра Drupal и модулей на Drupal.org, разрабатываем свои <a href="#">модули Drupal</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 expertise-col">
                                        <div class="expertise-item">
                                            <div class="expertise-item-body">
                                                Поддерживаем сайты на Drupal 5, 6, 7 и 8
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="expertise-img">
                        <img src="img/laptop.png" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="block-tariffs">
                <div class="block-title-tariffs">
                    Тарифы
                </div>
                <div class="tariffs">
                    <div class="container">
                        <div class="row row-flex tariffs-row">

                            <div class="col-sm-4 col-xs-12 col-flex">
                                <div class="tariff">
                                    <div class="tariff-wrapper">
                                        <div class="tariff-header">
                                            <div class="tariff-title">
                                                Стартовый
                                            </div>
                                            <br>
                                        </div>
                                        <div class="tariff-body">
                                            <div class="tariff-body-item">
                                                Консультации и работы по SEO
                                            </div>
                                            <div class="tariff-body-item">
                                                Услуги дизайнера
                                            </div>
                                            <div class="tariff-body-item">
                                                Неиспользованные оплаченные часы переносятся на следующий месяц
                                            </div>
                                            <div class="tariff-body-item">
                                                Предоплата от 6 000 рублей в месяц
                                            </div>
                                        </div>
                                        <div class="tariff-footer">
                                            <a href="#" class="contact-form tariff-footer-btn"> Свяжитесь с нами! </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12 col-flex">
                                <div class="tariff">
                                    <div class="tariff-wrapper">
                                        <div class="tariff-header">
                                            <div class="tariff-title">
                                                Бизнес
                                            </div>
                                            <br>
                                        </div>
                                        <div class="tariff-body">
                                            <div class="tariff-body-item">
                                                Консультации и работы по SEO
                                            </div>
                                            <div class="tariff-body-item">
                                                Услуги дизайнера
                                            </div>
                                            <div class="tariff-body-item">
                                                Высокое время реакции - до 2 рабочих дней
                                            </div>
                                            <div class="tariff-body-item">
                                                Неиспользованные оплаченные часы не переносятся
                                            </div>
                                            <div class="tariff-body-item">
                                                Предоплата от 30 000 рублей в месяц
                                            </div>
                                        </div>
                                        <div class="tariff-footer">
                                            <a href="#" class="contact-form tariff-footer-btn"> Свяжитесь с нами! </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12 col-flex">
                                <div class="tariff">
                                    <div class="tariff-wrapper">
                                        <div class="tariff-header">
                                            <div class="tariff-title">
                                                VIP
                                            </div>
                                            <br>
                                        </div>
                                        <div class="tariff-body">
                                            <div class="tariff-body-item">
                                                Консультации и работы по SEO
                                            </div>
                                            <div class="tariff-body-item">
                                                Услуги дизайнера
                                            </div>
                                            <div class="tariff-body-item">
                                                Максимальное время реакции - в день обращения
                                            </div>
                                            <div class="tariff-body-item">
                                                Неиспользованные оплаченные часы не переносятся
                                            </div>
                                            <div class="tariff-body-item">
                                                Предоплата от 270 000 рублей в месяц
                                            </div>
                                        </div>
                                        <div class="tariff-footer">
                                            <a href="#" class="contact-form tariff-footer-btn"> Свяжитесь с нами! </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="tariff-dop">
                                    Вам не подходят наши тарифы? Оставьте заявку и мы предложим вам индивидуальные условия!
                                    <a href="#" clas="contact-form tariffs-link">Получить индивидуальный тариф</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="team container">
                <h2 class="block-title">
                    Команда
                </h2>
                <div class="form-group">
                    <div class="view-content">

                        <div class="col-xs-6 col-sm-6 col-md-4 views-row">
                            <div class="user-teaser">
                                <div class="user-teaser-photo">
                                    <img src="img/IMG_2472_0.jpg" width="280px" height="280px" class="img-responsive">
                                </div>
                                <div class="user-teaser-name">
                                    <a href="#"> 
                                        Сергей Синица
                                    </a>
                                </div>
                                <div class="user-teaser-post">
                                    Руководитель отдела веб-разработки, канд. техн. наук, заместитель директора
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-4 views-row">
                            <div class="user-teaser">
                                <div class="user-teaser-photo">
                                    <img src="img/IMG_2539_0.jpg" width="280px" height="280px" class="img-responsive">
                                </div>
                                <div class="user-teaser-name">
                                    <a href="#"> 
                                        Роман Агабеков
                                    </a>
                                </div>
                                <div class="user-teaser-post">
                                    Руководитель отдела DevOPS, директор
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-4 views-row">
                            <div class="user-teaser">
                                <div class="user-teaser-photo">
                                    <img src="img/IMG_2474_1.jpg" width="280px" height="280px" class="img-responsive">
                                </div>
                                <div class="user-teaser-name">
                                    <a href="#"> 
                                        Алексей Синица
                                    </a>
                                </div>
                                <div class="user-teaser-post">
                                    Руководитель отдела поддержки сайтов
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-4 views-row">
                            <div class="user-teaser">
                                <div class="user-teaser-photo">
                                    <img src="img/IMG_2522_0.jpg" width="280px" height="280px" class="img-responsive">
                                </div>
                                <div class="user-teaser-name">
                                    <a href="#"> 
                                        Дарья Бочкарёва
                                    </a>
                                </div>
                                <div class="user-teaser-post">
                                    Руководитель отдела продвижения, контекстной рекламы и контент-поддержки сайтов
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-4 views-row">
                            <div class="user-teaser">
                                <div class="user-teaser-photo">
                                    <img src="img/IMG_9971_16.jpg" width="280px" height="280px" class="img-responsive">
                                </div>
                                <div class="user-teaser-name">
                                    <a href="#"> 
                                        Ирина Торкунова
                                    </a>
                                </div>
                                <div class="user-teaser-post">
                                    Менеджер по работе с клиентами
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="more-link form-group">
                        <a href="#"> вся команда</a>
                    </div>
                </div>
            </div>
            <div class="news container">
                <div class="block-title">
                    Последние кейсы
                </div>
                <div class="form-group">
                    <div class="view-content">
                        <article about="#" class="blog is-promoted keys-1">
                            <div class="keys1-wrapper">
                                <div class="keys1-picture">
                                    <img src="img/image 11.1.png" width="360px" height="215px">
                                </div>
                                <div class="keys1-container">
                                    <div class="keys1-header">
                                        <h2>
                                            <a herf="#">
                                                <span>
                                            Настройка кэширования данных. Апгрейд сервера. Ускорение работы сайта в 30 раз! 
                                            </span>
                                            </a>
                                        </h2>
                                        <div class="keys1-header-date">04.05.2020</div>
                                    </div>
                                    <div class="keys1-body">
                                        <p>Влияние скорости загрузки страниц сайта на отказы и конверсии. Кейс ускорения...</p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article about="#" class="blog is-promoted keys-2">
                            <div class="keys2-wrapper">
                                <div class="keys2-picture">
                                    <img src="img/laptop.jpg" width="800px">
                                </div>
                                <div class="keys2-container">
                                    <div class="keys2-header">
                                        <h2>
                                            <a herf="#">
                                                <span>
                                                    Использование отчетов Ecommerce в Яндекс.Метрике 
                                            </span>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="keys2-body">

                                    </div>
                                </div>
                            </div>
                        </article>
                        <article about="#" class="blog is-promoted keys-1">
                            <div class="keys1-wrapper">
                                <div class="keys1-picture">
                                    <img src="img/image 8.3.png" height="480px">
                                </div>
                                <div class="keys1-container">
                                    <div class="keys1-header">
                                        <h2>
                                            <a herf="#" class="link_keys">
                                                <span>
                                            
                                                    Повышение конверсии страницы с формой заявки с применением AB-тестирования
                                            
                                            </span>
                                            </a>
                                        </h2>
                                        <div class="keys1-header-date">
                                            24.01.2020
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article about="#" class="blog is-promoted keys-1">
                            <div class="keys1-wrapper">
                                <div class="keys1-picture">
                                    <img src="img/image 7.3.png" height="480px">
                                </div>
                                <div class="keys1-container">
                                    <div class="keys1-header">
                                        <h2>
                                            <a herf="#" class="link_keys">
                                                <span>
                                            
                                                    Drupal 7: ускорение времени генерации страниц интернет-магазина на 32%                                            
                                            </span>
                                            </a>
                                        </h2>
                                        <div class="keys1-header-date">
                                            24.01.2020
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article about="#" class="blog is-promoted keys-1">
                            <div class="keys1-wrapper">
                                <div class="keys1-picture">
                                    <img src="img/image 11.1.png" height="250px">
                                </div>
                                <div class="keys1-container">
                                    <div class="keys1-header">
                                        <h2>
                                            <a herf="#">
                                                <span>
                                            
                                                    Обмен товарами и заказами интернет-магазинов на Drupal 7 с 1С: Предприятие, МойСклад, Класс365                                            </span>
                                            </a>
                                        </h2>
                                        <div class="keys1-header-date">

                                            22.08.2019
                                        </div>
                                    </div>
                                    <div class="keys1-body">
                                        <p>Опубликован релиз модуля...</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="otzyvi container">
                <h2 class="block-title"> Отзывы </h2>
                <div class="form-group">
                    <div class="container">
                        <div class="view-content">
                            <div class="slick">
                                <div class="slick-slider">

                                    <div class="slide--1">
                                        <div class="image-logo">
                                            <img src="img/logo_2.png" width="100px" height="50px">
                                        </div>
                                        <div class="field-content">
                                            Сергей — профессиональный, высококвалифицированый программист с огромным опытом в ИТ. Я долгое время общался с топ-фрилансерами (вся первая двадцатка) на веблансере и могу сказать, что С СЕРГЕЕМ ОНИ И РЯДОМ НЕ ВАЛЯЛИСЬ. Работаем с Сергеем до сих пор.
                                            С ним приятно работать, я доволен.
                                        </div>
                                        <div class="views-field views-field-field-report-author">
                                            <div class="field-content">Сергей Чепурко, руководитель проекта&nbsp;<a href="http://www.personal-writer.com/" tabindex="0">www.personal-writer.com</a>&nbsp;/&nbsp;<a href="http://www.writers-united.org/" tabindex="0">www.writers-united.org</a></div>
                                        </div>
                                    </div>

                                    <div class="slide--1">
                                        <div class="image-logo">
                                            <img src="img/logo_0.png" width="100px" height="50px">
                                        </div>
                                        <div class="field-content">
                                            Долгие поиски единственного и неповторимого мастера на многострадальный сайт www.cielparfum.com, который был собран крайне некомпетентным программистом и раз в месяц стабильно грозил погибнуть, привели меня на сайт и, в итоге, к ребятам из Drupal-coder.
                                            И вот уже практически полгода как не проходит и дня, чтобы я не поудивлялась и не порадовалась своему везению! Починили все, что не работало - от поиска до отображения меню. Провели редизайн - не отходя от желаемого,
                                            но со своими существенными и качественными дополнениями. Осуществили ряд проектов - конкурсы, тесты и тд. А уж мелких починок и доработок - не счесть! И главное - все качественно и быстро (не взирая на не самый
                                            "быстрый" тариф). Есть вопросы - замечательный Алексей всегда подскажет, поддержит, отремонтирует и/или просто сделает с нуля. Есть задумка для реализации - замечательный Сергей обсудит и предложит идеальный
                                            вариант. Есть проблема - замечательные Надежда и Роман починят, поправят, сделают! Ребята доказали, что эта CMS - мощная и грамотная система управления. Надеюсь, что наше сотрудничество затянется надолго! Спасибо!!!
                                        </div>
                                        <div class="views-field views-field-field-report-author">
                                            <div class="field-content">С уважением, Наталья Сушкова руководитель Отдела веб-проектов Группы компаний «Си Эль парфюм»&nbsp;<a href="http://www.cielparfum.com/" tabindex="0">http://www.cielparfum.com/</a></div>
                                        </div>
                                    </div>
                                </div>
                                <nav class="slick__arrow">
                                    <div class="slick__arrow-wrapper">
                                        <div class="prev" aria-label="Previous" role="button">
                                        </div>
                                        <span class="slick-slide-num">
                                        <span class="slick-slide-num-current" id="click">01</span> / 02</span>
                                        <div class="next" aria-label="Next" role="button">
                                        </div>
                                    </div>
                                </nav>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
<!--            <div class="working_with_us">-->
<!--                <h2 class="block-title">-->
<!--                    С нами работают-->
<!--                </h2>-->
<!--                <div class="form-group">-->
<!--                    <div class="view-header">-->

<!--                        Десятки компаний доверяют нам самое ценное, что у них есть в интернете – свои сайты. Мы делаем всё, чтобы наше сотрудничество было долгим.-->

<!--                    </div>-->
<!--                    <div class="view-content">-->
<!--                        <div class="slick-slider-two">-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/cableman_ru.png">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="slick-slider-three">-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->
<!--                            <div class="image-in-slide">-->
<!--                                <img src="img/farbors_ru.jpg">-->
<!--                            </div>-->


<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->


        </div>
    </div>


    <div class="containerS">
  <h1 class="nice-header">FAQ</h1>
  <div class="faq">
    <ol type="1" class="faq-questions">
      <li>
        <h4 class="faq-question">Кто непосредственно занимается поддержкой?</h4>
        <p class="faq-answer">Сайты поддерживают штатные сотрудники ООО "Инитлаб", г. Краснодара, прошедшие специальное обучение и имеющие опыт работы с Друпал от 4 до 15 лет. 8 web-разработчиков, 2 специалиста по SEO, 4 системных администратора.</p>
      </li>
      <li>
        <h4 class="faq-question">Как организована работа поддержки?</h4>
        <p class="faq-answer"><Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Что происходит, когда отработаны все предоплаченные часы за месяц?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Что происходит, когда не отработаны все предоплаченные часы за месяц?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Как происходит оценка и согласование планируемого времени на выполнение заявок?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Сколько программистов выделяется на проект?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Как подать заявку на внесение изменений на сайте?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question"> Как подать заявку на добавление пользователя, изменение настроек веб-сервера и других задач по администрированию?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">В течение какого времени начинается работа по заявке?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">В какое время работает поддержка? </h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Подходят ли услуги поддержки, если необходимо произвести обновление ядра Drupal или модулей?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
      <li>
        <h4 class="faq-question">Можно ли пообщаться со специалистом голосом или в мессенджере?</h4>
        <p class="faq-answer">Ответ</p>
      </li>
    </ol>
  </div>
</div>



    <footer class="footer">
    <div class="container">
        <div>
            <section class="block clear" id="support">
                <h6>&nbsp;</h6>
                <div class="row">

                    <div class="col-md-6 col-xs-12 col-sm-6">

                        <div class="field ftp-56"><div class="block-form-wrapper">
                            <div class="block-form-title">Оставить заявку на <br>поддержку сайта</div>

                            <div class="block-form-description">Срочно нужна поддержка сайта? Ваша команда не успевает справиться самостоятельно или предыдущий подрядчик не справится с работой? Тогда вам точно к нам! Просто оставьте заявку и наш менеджер с вами свяжется!</div>

                            <div class="block-form-contacts">
                                <ul>
                                    <li class="block-form-phone"><a href="tel:8800222-26-73">&#9742;8 800 222-26-73</a></li>
                                    <li class="block-form-email"><a href="mailto:sales@drupal-coding.com">&#9993;info@drupal-coder.ru</a></li>
                                </ul>
                            </div>
                        </div></div>

                    </div>

                    <div class="col-md-6 col-xs-12 col-sm-6">

    <!-- Контейнер формы и отображение ошибок -->
    <div class="field form-container">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $err): ?>
                <p class="error-message"><?= htmlspecialchars($err) ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Если пользователь не авторизован — показываем форму ввода заявки -->
        <?php if (empty($username)): ?>
            <form class="contact-form" id="regform" method="post" action="form.php">
                
                <!-- Поле ФИО -->
                <div class="form-group">
                    <div class="form-item form-type-textfield form-group">
                        <input 
                            class="form-text <?php if (in_array("name", $errorFields)): ?>cookie-error-group<?php endif; ?>" 
                            id="field-name-value" 
                            name="name" 
                            value="<?= $get('name') ?>" 
                            placeholder="ФИО"
                        >
                    </div>
                    <?php if (in_array("name", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Допустимы только буквы кириллицы и латиницы (например, Иванов Иван Иванович).
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Поле телефон -->
                <div class="form-group" id="form-phone-wrapper">
                    <div class="form-item js-form-item form-type-textfield form-group">
                        <input 
                            class="form-text <?php if (in_array("phone", $errorFields)): ?>cookie-error-group<?php endif; ?>" 
                            name="phone" 
                            value="<?= $get('phone') ?>" 
                            placeholder="Номер телефона"
                        >
                    </div>
                    <?php if (in_array("phone", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Номер телефона указывается в формате +XXXXXXXXXXX; допустимы только цифры.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Поле e-mail -->
                <div class="form-group">
                    <div class="form-item form-group">
                        <input 
                            class="form-text <?php if (in_array("email", $errorFields)): ?>cookie-error-group<?php endif; ?>" 
                            name="email" 
                            value="<?= $get('email') ?>" 
                            placeholder="Эл. почта"
                        >
                    </div>
                    <?php if (in_array("email", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Формат адреса: example@domain.com; допустимы буквы, цифры, точки, дефисы и символ @.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Поле дата рождения -->
                <div class="form-group">
                    <div class="form-item form-group">
                        <input 
                            class="form-text <?php if (in_array("dob", $errorFields)): ?>cookie-error-group<?php endif; ?>" 
                            name="dob" 
                            value="<?= $get('dob') ?>" 
                            placeholder="Дата рождения" 
                            type="date"
                        >
                    </div>
                    <?php if (in_array("dob", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Поле должно содержать дату в формате ГГГГ-ММ-ДД.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Радиокнопки для выбора пола -->
                <div class="form-group">
                    <div class="form-item form-group <?php if (in_array("gender", $errorFields)): ?>cookie-error-group<?php endif; ?>">
                        Ваш пол:<br>
                        <input 
                            type="radio" 
                            class="form-type-radio radio"
                            name="gender" 
                            value="male" 
                            <?= $get('gender') === 'male' ? 'checked' : '' ?>
                        > Мужчина<br>
                        <input 
                            type="radio" 
                            class="form-type-radio radio"
                            name="gender" 
                            value="female" 
                            <?= $get('gender') === 'female' ? 'checked' : '' ?>
                        > Женщина
                    </div>
                    <?php if (in_array("gender", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Поле обязательно для выбора; выберите один из вариантов.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Множественный выбор языков программирования -->
                <div class="form-group">
                    <div class="form-item form-group">
                        Ваши любимые языки программирования:<br>
                        <select 
                            name="languages" 
                            class="form-type-select select <?php if (in_array("languages", $errorFields)): ?>cookie-error-group<?php endif; ?>" 
                            multiple="multiple"
                        >
                            <?php
                                $chosen = isset($_COOKIE['languages'])
                                    ? json_decode($_COOKIE['languages'], true)
                                    : [];
                                $all = ['Pascal','C','C++','JavaScript','PHP','Python','Java','Haskell','Clojure','Prolog','Scala','Go'];
                                foreach ($all as $lang):
                            ?>
                                <option 
                                    value="<?= $lang ?>" 
                                    <?= in_array($lang, $chosen) ? 'selected' : '' ?>
                                >
                                    <?= $lang ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if (in_array("languages", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Поле должно содержать хотя бы один выбранный язык программирования; можно выбрать несколько.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Текстовое поле для биографии -->
                <div class="form-group">
                    <div class="form-item form-group">
                        <textarea 
                            class="form-text <?php if (in_array("bio", $errorFields)): ?>cookie-error-group<?php endif; ?>" 
                            id="Bio" 
                            name="bio" 
                            placeholder="Биография"
                        ><?= $get('bio') ?></textarea>
                    </div>
                    <?php if (in_array("bio", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Допустимы латинские и кириллические буквы, цифры, пробельные символы и символы ";,.:-!?
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Чекбокс для подтверждения соглашения -->
                <div class="form-item form-type-checkbox checkbox">
                    <label for="agreement" class="control-label option form-required <?php if (in_array("contract", $errorFields)): ?>cookie-error-group<?php endif; ?>">
                        <input 
                            class="form-checkbox required" 
                            type="checkbox" 
                            name="contract"
                        >
                        Отправляя заявку, я даю согласие на 
                        <a href="" target="_blank" rel="nofollow">обработку персональных данных.*</a>
                    </label>
                    <?php if (in_array("contract", $errorFields)): ?>
                        <div class="cookie-error-description">
                            Поле обязательно для подтверждения; поставьте галочку.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Кнопка отправки заявки -->
                <div class="form-group" id="edit-actions">
                    <button class="btn" type="submit" id="edit-submit" name="op">
                        Сохранить данные
                    </button>
                </div>
            </form>

            <!-- Кнопка для перехода на страницу входа -->
            <form class="form-container" action="login.php" method="get">
                Уже есть профиль?
                <div class="form-group" id="edit-actions">
                    <button class="btn" type="submit">Войти</button>
                </div>
            </form>

        <!-- Если пользователь уже авторизован — показываем приветствие и кнопки -->
        <?php else: ?>
            <form class="form-container">
                Здравствуйте, <?= htmlspecialchars($username) ?>!
                <div class="form-group">
                    <button class="btn" type="button" onclick="window.location.href = 'edit.php'">
                        Изменить данные
                    </button>
                </div>
                <br>
                Это не вы?
                <div class="form-group">
                    <button class="btn" type="button" onclick="window.location.href = 'logout.php'">
                        Выйти
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

                    </div>
                </div>
            </section>

            <section id="block-copyright" class="block clear">
                <h6>&nbsp;</h6>
                <div class="fpt-56   "><p>Проект ООО «Инитлаб», Краснодар, Россия. <br>
                    Drupal является зарегистрированной торговой маркой Dries Buytaert.</p></div>
            </section>


        </div>

    </div>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/slick.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="public_slick.js"></script>
		<script type="text/javascript" src="public_slick.min.js"> </script>
    <script type="text/javascript" src="public_faq.js"> </script>

</body>
</html>
