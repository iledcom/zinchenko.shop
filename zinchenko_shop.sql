-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 22 2021 г., 09:06
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zinchenko_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'Сумки', 5, 1),
(2, 'Платья', 1, 1),
(3, 'Футболки', 2, 1),
(4, 'Блузки', 3, 1),
(6, 'Майки', 6, 1),
(7, 'Джинсы', 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) NOT NULL,
  `writing_date` date DEFAULT NULL,
  `is_new` int(11) NOT NULL,
  `is_recommended` int(11) NOT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `short_content`, `img`, `link`, `content`, `category_id`, `writing_date`, `is_new`, `is_recommended`, `status`) VALUES
(1, 'IBM обязуется обеспечить навыками 30 млн человек по всему миру к 2030 году', 'Компания объявляет о более 170 новых партнерствах и расширении программного взаимодействия с учреждениями и организациями из свыше 30 стран Америки АТР, Европы, Ближнего Востока и Африки', 'https://senior.ua/storage/news/573a601f-8d56-493c-9e4e-c75e6badf6fc.jpeg', 'https://senior.ua/news/ibm-obyazuetsya-obespechit-navykami-30-mln-chelovek-po-vsemu-miru-k-2030-godu', NULL, 1, '2021-10-20', 1, 0, 1),
(2, 'В &quot;Дие&quot; произошел сбой: что происходит', '&nbsp;Возникает проблема с входом в один из разделов в мобильном приложении', 'https://senior.ua/storage/news/95c6d827-1972-4895-83ef-b380936dac44.jpeg', 'https://senior.ua/news/v-die-proizoshel-sboy-chto-proishodit', NULL, 1, '2021-10-20', 1, 0, 1),
(3, 'Intel помогла NASA в изучении с помощью ИИ воздействия космической радиации на астронавтов', 'Специалисты Intel и FDL разработали алгоритм причинно-следственного машинного обучения, доступный всем участники проекта', 'https://senior.ua/storage/news/f0fd911f-6797-4822-bbcd-f110a6187588.jpeg', 'https://senior.ua/news/intel-pomogla-nasa-v-izuchenii-s-pomoschyu-ii-vozdeystviya-kosmicheskoy-radiacii-na-astronavtov', NULL, 1, '2021-10-20', 1, 0, 1),
(4, 'В Instagram разрешили публикации с компьютеров', 'Команда Instagram, входящая в состав Facebook, запускает для пользователей ряд давно ожидаемых функций. Самая долгожданная из них - возможность делать публикации в Instagram с компьютеров', 'https://senior.ua/storage/news/199caa08-79a9-4d35-84c0-9db757e20666.jpeg', 'https://senior.ua/news/v-instagram-razreshili-publikacii-s-kompyuterov', NULL, 0, '2021-10-20', 0, 0, 1),
(5, 'Цукерберг изменит название компании Facebook ради своей метавселенной', 'Руководство Facebook, которое в последнее время занялось созданием виртуальной метавселенной, планирует изменить название компании.', 'https://senior.ua/storage/news/ac2d1be1-0cf5-4c08-9ed2-2f997cbebbe2.jpeg', 'https://senior.ua/news/cukerberg-izmenit-nazvanie-kompanii-facebook-radi-svoey-metavselennoy', NULL, 0, '2021-10-20', 0, 0, 1),
(6, 'Дослідження: у Львові за 6 років кількість ІТ-фахівців зросла майже на 80%', 'ІТ-галузь Львова зростає чи не найшвидше в Україні &ndash; за 6 років кількість фахівців зросла майже на 80%', 'https://senior.ua/storage/news/65ce3293-9750-4636-ba08-cf9c39a0ee36.jpeg', 'https://senior.ua/news/dosldzhennya-u-lvov-za-6-rokv-klkst-tfahvcv-zrosla-mayzhe-na-80', NULL, 0, '2021-10-20', 0, 0, 1),
(7, '10 процессорных ядер, до 32 графических и рекордное количество транзисторов. Apple представила SoC M1 Pro и M1 Max для новых MacBook Pro', 'Компания Apple только что представила две новые однокристальные системы своего семейства Apple Silicon. Называются они M1 Pro и M1 Max, как и утверждали самые свежие слухи', 'https://senior.ua/storage/news/f6b149ff-457e-433f-83b2-a4ba045298b1.jpeg', 'https://senior.ua/news/10-processornyh-yader-do-32-graficheskih-i-rekordnoe-kolichestvo-tranzistorov-apple-predstavila-soc-m1-pro-i-m1-max-dlya-novyh-macbook-pro', NULL, 0, '2021-10-20', 0, 0, 1),
(8, 'Новые мониторы от Apple можно протирать только салфетками за 500 гривен', 'В Apple заявили, что подобное стекло можно чистить только такой салфеткой и подчеркнули, что его нельзя протирать другими материалами', 'https://senior.ua/storage/news/d34d19d0-235a-423b-a236-ac5024ac670c.jpeg', 'https://senior.ua/news/novye-monitory-ot-apple-mozhno-protirat-tolko-salfetkami-za-500-griven', NULL, 0, '2021-10-20', 0, 0, 1),
(9, 'AI HOUSE запускає Deep Learning Creator School. Нова безкоштовна offline-школа машинного навчання в Києві.', 'Школу створено для фахівців із досвідом роботи від одного року, що прагнуть розширити свої знання й одразу застосувати їх на практиці', 'https://senior.ua/storage/news/2bbe28af-1d27-47c0-b21c-5292f641a9cf.jpeg', 'https://senior.ua/news/ai-house-zapuska-deep-learning-creator-school-nova-bezkoshtovna-offlineshkola-mashinnogo-navchannya-v-kiv', NULL, 0, '2021-10-20', 0, 0, 1),
(10, 'Школы Великобритании начнут использовать систему распознавания лиц в школьных столовых', 'Это поможет сократить количество прикосновений в пандемию, а также ускорить процесс обслуживания', 'https://senior.ua/storage/news/e165566b-89ac-4668-83a3-e0b376226863.jpeg', 'https://senior.ua/news/shkoly-velikobritanii-nachnut-ispolzovat-sistemu-raspoznavaniya-lic-v-shkolnyh-stolovyh', NULL, 0, '2021-10-20', 0, 0, 1),
(11, 'Samsung установила рекорд по скорости передачи данных в сетях 5G', 'Компания Samsung объявила о том, что она побила очередной отраслевой рекорд скорости для сетей 5G', 'https://senior.ua/storage/news/3f0f65dc-2806-40d2-9548-4f39013a5ac7.jpeg', 'https://senior.ua/news/samsung-ustanovila-rekord-po-skorosti-peredachi-dannyh-v-setyah-5g', NULL, 0, '2021-10-20', 0, 0, 1),
(12, 'Устроивший утечку геймплейного отрывка Elden Ring блогер оказался недобросовестным тестировщиком игры', 'Вскоре после публикации оригинальный ролик пропал: как выяснилось, его удалил сам Games Anime and more, испугавшись возможных юридических последствий своего поступка', 'https://senior.ua/storage/news/93264b94-5297-49c3-b530-747e203ccc0a.jpeg', 'https://senior.ua/news/ustroivshiy-utechku-geympleynogo-otryvka-elden-ring-bloger-okazalsya-nedobrosovestnym-testirovschikom-igry', NULL, 0, '2021-10-20', 0, 0, 1),
(13, 'Facebook наймет 10 тысяч человек для создания виртуального мира', 'Уже начали тестировать приложения для удаленной работы. Оно позволяет с помощью спецгарнитуры присутствовать на совещаниях в виде своих аватаров', 'https://senior.ua/storage/news/42a24baa-8d27-45d4-b5e3-c0b72f04769a.jpeg', 'https://senior.ua/news/facebook-naymet-10-tysyach-chelovek-dlya-sozdaniya-virtualnogo-mira', NULL, 0, '2021-10-20', 0, 0, 1),
(14, 'Google презентовала операционную систему Android 12', 'Компания Google представила новую версию мобильной операционной системы Android 12. ОС стала доступна для скачивания всем пользователям', 'https://senior.ua/storage/news/99ea717f-b0b1-4c43-a323-00d972acbb1c.jpeg', 'https://senior.ua/news/google-prezentovala-operacionnuyu-sistemu-android-12', NULL, 0, '2021-10-20', 0, 0, 1),
(15, 'Microsoft отказалась от 3D-эмодзи в Windows 11', 'Microsoft ранее пообещала установить новые 3D-эмодзи для Windows 11 и нескольких других продуктов. Однако теперь компания отказалась от своих намерений по крайней мере для новой ОС &mdash; в сборках на Dev Channel вышли плоские или 2D-эмодзи', 'https://senior.ua/storage/news/6a741400-def2-48a6-8314-4c0a4a37751b.jpeg', 'https://senior.ua/news/microsoft-otkazalas-ot-3demodzi-v-windows1', NULL, 0, '2021-10-20', 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news_category`
--

CREATE TABLE `news_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news_category`
--

INSERT INTO `news_category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'Новости', 1, 1),
(2, 'Статьи', 2, 1),
(3, 'Служебная информация', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(46, 'Piazza Italia 69272 52 p Denim', 7, 53543, 552, 1, 'Piazza', '', '', 0, 0, 1),
(47, 'DKNY BTF104762 32 Голубые', 7, 17468, 777, 1, 'DKNY', '', '', 1, 1, 1),
(48, 'Piazza Italia 70016 XL Oil', 7, 87345, 832, 1, 'Piazza', '', '', 0, 1, 1),
(49, 'G-Star Raw 51030Є 5683 29-32 p Синие', 7, 17849, 1229, 0, 'G-Star', '', '', 1, 1, 1),
(50, 'G-Star Raw 51030Є 5683 29-32 p Красные', 7, 83222, 1009, 0, 'G-Star', '', '', 0, 1, 1),
(51, 'Piazza Italia 70016 M Oil', 7, 12267, 788, 1, 'Piazza', '', '', 0, 1, 1),
(52, 'Piazza Italia 69272', 7, 23323, 880, 1, 'Piazza', '', '', 0, 0, 1),
(53, 'Piazza 69244 52 p Желтые', 7, 91122, 299, 1, 'Piazza', '', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'Александр', 'alex@mail.com', '111111', ''),
(4, 'Виктор Зинченко', 'zinchenko.us@gmail.com', '222222', 'admin'),
(5, 'Сергей', 'serg@mail.com', '111111', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `news_category`
--
ALTER TABLE `news_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
