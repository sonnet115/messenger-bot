-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 05:12 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bot`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fb_id`, `first_name`, `last_name`, `profile_pic`, `contact`, `billing_address`, `shipping_address`, `created_at`, `updated_at`) VALUES
(1, '2723987454293264', 'Mehedi', 'Sonet', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?psid=2723987454293264&width=1024&ext=1594990389&hash=AeSv1hEbvKhD-gwq', '01707725788', 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '2020-06-17 12:53:09', '2020-06-17 20:36:42'),
(2, '2624477377673422', 'Mehedi Hasan', 'Sonnet', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?psid=2624477377673422&width=1024&ext=1595089241&hash=AeQ0TsgMom5OCk_X', NULL, NULL, NULL, '2020-06-18 16:20:42', '2020-06-18 16:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers_shops`
--

CREATE TABLE `customers_shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dis_from` date NOT NULL,
  `dis_to` date NOT NULL,
  `pid` int(11) NOT NULL,
  `dis_percentage` double(8,2) NOT NULL DEFAULT 0.00,
  `max_customers` smallint(6) DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(6, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\Bot\\\\ReceiptHandler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\Bot\\\\ReceiptHandler\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\\":12:{s:36:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000receipt\\\";O:15:\\\"App\\\\Bot\\\\Receipt\\\":3:{s:28:\\\"\\u0000App\\\\Bot\\\\Receipt\\u0000recipientId\\\";s:16:\\\"2723987454293264\\\";s:34:\\\"\\u0000App\\\\Bot\\\\Receipt\\u0000placed_order_data\\\";O:9:\\\"App\\\\Order\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:4:{i:0;s:3:\\\"pid\\\";i:1;s:11:\\\"customer_id\\\";i:2;s:11:\\\"product_qty\\\";i:3;s:8:\\\"subtotal\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:6:\\\"orders\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:13:{s:2:\\\"id\\\";i:9;s:4:\\\"code\\\";s:16:\\\"1592426202_85872\\\";s:13:\\\"customer_name\\\";s:12:\\\"Mehedi Sonet\\\";s:11:\\\"customer_id\\\";i:1;s:15:\\\"billing_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:16:\\\"shipping_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:7:\\\"contact\\\";s:11:\\\"01707725788\\\";s:24:\\\"additional_order_details\\\";N;s:12:\\\"order_status\\\";i:0;s:17:\\\"status_updated_by\\\";N;s:7:\\\"shop_id\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:13:{s:2:\\\"id\\\";i:9;s:4:\\\"code\\\";s:16:\\\"1592426202_85872\\\";s:13:\\\"customer_name\\\";s:12:\\\"Mehedi Sonet\\\";s:11:\\\"customer_id\\\";i:1;s:15:\\\"billing_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:16:\\\"shipping_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:7:\\\"contact\\\";s:11:\\\"01707725788\\\";s:24:\\\"additional_order_details\\\";N;s:12:\\\"order_status\\\";i:0;s:17:\\\"status_updated_by\\\";N;s:7:\\\"shop_id\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:1:{s:16:\\\"ordered_products\\\";O:39:\\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:2:{i:0;O:11:\\\"App\\\\Product\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:5:{i:0;s:4:\\\"name\\\";i:1;s:4:\\\"code\\\";i:2;s:5:\\\"stock\\\";i:3;s:3:\\\"uom\\\";i:4;s:5:\\\"price\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:8:\\\"products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:2:\\\"id\\\";i:3;s:4:\\\"name\\\";s:21:\\\"Pakistani Three Piece\\\";s:4:\\\"code\\\";s:9:\\\"PTP-30928\\\";s:5:\\\"stock\\\";i:998;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1350;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:26:40\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:15:{s:2:\\\"id\\\";i:3;s:4:\\\"name\\\";s:21:\\\"Pakistani Three Piece\\\";s:4:\\\"code\\\";s:9:\\\"PTP-30928\\\";s:5:\\\"stock\\\";i:998;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1350;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:26:40\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";s:9:\\\"pivot_oid\\\";i:9;s:9:\\\"pivot_pid\\\";i:3;s:14:\\\"pivot_quantity\\\";i:1;s:11:\\\"pivot_price\\\";i:1350;s:14:\\\"pivot_discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:1:{s:5:\\\"pivot\\\";O:44:\\\"Illuminate\\\\Database\\\\Eloquent\\\\Relations\\\\Pivot\\\":29:{s:12:\\\"incrementing\\\";b:0;s:10:\\\"\\u0000*\\u0000guarded\\\";a:0:{}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";s:16:\\\"ordered_products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:5:{s:3:\\\"oid\\\";i:9;s:3:\\\"pid\\\";i:3;s:8:\\\"quantity\\\";i:1;s:5:\\\"price\\\";i:1350;s:8:\\\"discount\\\";d:0;}s:11:\\\"\\u0000*\\u0000original\\\";a:5:{s:3:\\\"oid\\\";i:9;s:3:\\\"pid\\\";i:3;s:8:\\\"quantity\\\";i:1;s:5:\\\"price\\\";i:1350;s:8:\\\"discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:11:\\\"pivotParent\\\";O:9:\\\"App\\\\Order\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:4:{i:0;s:3:\\\"pid\\\";i:1;s:11:\\\"customer_id\\\";i:2;s:11:\\\"product_qty\\\";i:3;s:8:\\\"subtotal\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";s:6:\\\"orders\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:0;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000original\\\";a:0:{}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}s:13:\\\"\\u0000*\\u0000foreignKey\\\";s:3:\\\"oid\\\";s:13:\\\"\\u0000*\\u0000relatedKey\\\";s:3:\\\"pid\\\";}}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}i:1;O:11:\\\"App\\\\Product\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:5:{i:0;s:4:\\\"name\\\";i:1;s:4:\\\"code\\\";i:2;s:5:\\\"stock\\\";i:3;s:3:\\\"uom\\\";i:4;s:5:\\\"price\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:8:\\\"products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:2:\\\"id\\\";i:4;s:4:\\\"name\\\";s:14:\\\"Pakistani Lawn\\\";s:4:\\\"code\\\";s:7:\\\"PL-3094\\\";s:5:\\\"stock\\\";i:568;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1990;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:28:31\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:15:{s:2:\\\"id\\\";i:4;s:4:\\\"name\\\";s:14:\\\"Pakistani Lawn\\\";s:4:\\\"code\\\";s:7:\\\"PL-3094\\\";s:5:\\\"stock\\\";i:568;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1990;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:28:31\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:36:42\\\";s:9:\\\"pivot_oid\\\";i:9;s:9:\\\"pivot_pid\\\";i:4;s:14:\\\"pivot_quantity\\\";i:1;s:11:\\\"pivot_price\\\";i:1990;s:14:\\\"pivot_discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:1:{s:5:\\\"pivot\\\";O:44:\\\"Illuminate\\\\Database\\\\Eloquent\\\\Relations\\\\Pivot\\\":29:{s:12:\\\"incrementing\\\";b:0;s:10:\\\"\\u0000*\\u0000guarded\\\";a:0:{}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";s:16:\\\"ordered_products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:5:{s:3:\\\"oid\\\";i:9;s:3:\\\"pid\\\";i:4;s:8:\\\"quantity\\\";i:1;s:5:\\\"price\\\";i:1990;s:8:\\\"discount\\\";d:0;}s:11:\\\"\\u0000*\\u0000original\\\";a:5:{s:3:\\\"oid\\\";i:9;s:3:\\\"pid\\\";i:4;s:8:\\\"quantity\\\";i:1;s:5:\\\"price\\\";i:1990;s:8:\\\"discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:11:\\\"pivotParent\\\";r:147;s:13:\\\"\\u0000*\\u0000foreignKey\\\";s:3:\\\"oid\\\";s:13:\\\"\\u0000*\\u0000relatedKey\\\";s:3:\\\"pid\\\";}}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}}}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}s:31:\\\"\\u0000App\\\\Bot\\\\Receipt\\u0000total_discount\\\";i:0;}s:35:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000common\\\";O:14:\\\"App\\\\Bot\\\\Common\\\":0:{}s:41:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000text_message\\\";O:20:\\\"App\\\\Bot\\\\TextMessages\\\":1:{s:33:\\\"\\u0000App\\\\Bot\\\\TextMessages\\u0000recipientId\\\";s:16:\\\"2723987454293264\\\";}s:39:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000order_data\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:9:\\\"App\\\\Order\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:1:{i:0;s:16:\\\"ordered_products\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2020-06-18 02:36:43.917552\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:10:\\\"Asia\\/Dhaka\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Trying to get property \'order_code\' of non-object in F:\\xampp\\htdocs\\Bot\\app\\Jobs\\Bot\\ReceiptHandler.php:33\nStack trace:\n#0 F:\\xampp\\htdocs\\Bot\\app\\Jobs\\Bot\\ReceiptHandler.php(33): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Trying to get p...\', \'F:\\\\xampp\\\\htdocs...\', 33, Array)\n#1 [internal function]: App\\Jobs\\Bot\\ReceiptHandler->handle()\n#2 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#3 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(36): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#8 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#9 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#10 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\Bot\\ReceiptHandler), false)\n#12 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#13 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#14 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\Bot\\ReceiptHandler))\n#16 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(314): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(267): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->runNextJob(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 [internal function]: Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#24 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(36): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#26 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#27 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#28 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#29 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Command\\Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#31 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(1001): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(271): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(147): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(131): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#36 F:\\xampp\\htdocs\\Bot\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 {main}', '2020-06-17 20:36:43'),
(7, 'database', 'default', '{\"displayName\":\"App\\\\Jobs\\\\Bot\\\\ReceiptHandler\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\Bot\\\\ReceiptHandler\",\"command\":\"O:27:\\\"App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\\":12:{s:36:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000receipt\\\";O:15:\\\"App\\\\Bot\\\\Receipt\\\":3:{s:28:\\\"\\u0000App\\\\Bot\\\\Receipt\\u0000recipientId\\\";s:16:\\\"2723987454293264\\\";s:34:\\\"\\u0000App\\\\Bot\\\\Receipt\\u0000placed_order_data\\\";O:9:\\\"App\\\\Order\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:4:{i:0;s:3:\\\"pid\\\";i:1;s:11:\\\"customer_id\\\";i:2;s:11:\\\"product_qty\\\";i:3;s:8:\\\"subtotal\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:6:\\\"orders\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:13:{s:2:\\\"id\\\";i:10;s:4:\\\"code\\\";s:16:\\\"1592426291_52495\\\";s:13:\\\"customer_name\\\";s:12:\\\"Mehedi Sonet\\\";s:11:\\\"customer_id\\\";i:1;s:15:\\\"billing_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:16:\\\"shipping_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:7:\\\"contact\\\";s:11:\\\"01707725788\\\";s:24:\\\"additional_order_details\\\";N;s:12:\\\"order_status\\\";i:0;s:17:\\\"status_updated_by\\\";N;s:7:\\\"shop_id\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:13:{s:2:\\\"id\\\";i:10;s:4:\\\"code\\\";s:16:\\\"1592426291_52495\\\";s:13:\\\"customer_name\\\";s:12:\\\"Mehedi Sonet\\\";s:11:\\\"customer_id\\\";i:1;s:15:\\\"billing_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:16:\\\"shipping_address\\\";s:40:\\\"Mollapara, Taltola, West Agargaon, Dhaka\\\";s:7:\\\"contact\\\";s:11:\\\"01707725788\\\";s:24:\\\"additional_order_details\\\";N;s:12:\\\"order_status\\\";i:0;s:17:\\\"status_updated_by\\\";N;s:7:\\\"shop_id\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:1:{s:16:\\\"ordered_products\\\";O:39:\\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:2:{i:0;O:11:\\\"App\\\\Product\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:5:{i:0;s:4:\\\"name\\\";i:1;s:4:\\\"code\\\";i:2;s:5:\\\"stock\\\";i:3;s:3:\\\"uom\\\";i:4;s:5:\\\"price\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:8:\\\"products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:2:\\\"id\\\";i:3;s:4:\\\"name\\\";s:21:\\\"Pakistani Three Piece\\\";s:4:\\\"code\\\";s:9:\\\"PTP-30928\\\";s:5:\\\"stock\\\";i:994;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1350;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:26:40\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:15:{s:2:\\\"id\\\";i:3;s:4:\\\"name\\\";s:21:\\\"Pakistani Three Piece\\\";s:4:\\\"code\\\";s:9:\\\"PTP-30928\\\";s:5:\\\"stock\\\";i:994;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1350;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:26:40\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";s:9:\\\"pivot_oid\\\";i:10;s:9:\\\"pivot_pid\\\";i:3;s:14:\\\"pivot_quantity\\\";i:4;s:11:\\\"pivot_price\\\";i:1350;s:14:\\\"pivot_discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:1:{s:5:\\\"pivot\\\";O:44:\\\"Illuminate\\\\Database\\\\Eloquent\\\\Relations\\\\Pivot\\\":29:{s:12:\\\"incrementing\\\";b:0;s:10:\\\"\\u0000*\\u0000guarded\\\";a:0:{}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";s:16:\\\"ordered_products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:5:{s:3:\\\"oid\\\";i:10;s:3:\\\"pid\\\";i:3;s:8:\\\"quantity\\\";i:4;s:5:\\\"price\\\";i:1350;s:8:\\\"discount\\\";d:0;}s:11:\\\"\\u0000*\\u0000original\\\";a:5:{s:3:\\\"oid\\\";i:10;s:3:\\\"pid\\\";i:3;s:8:\\\"quantity\\\";i:4;s:5:\\\"price\\\";i:1350;s:8:\\\"discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:11:\\\"pivotParent\\\";O:9:\\\"App\\\\Order\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:4:{i:0;s:3:\\\"pid\\\";i:1;s:11:\\\"customer_id\\\";i:2;s:11:\\\"product_qty\\\";i:3;s:8:\\\"subtotal\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";s:6:\\\"orders\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:0;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:0:{}s:11:\\\"\\u0000*\\u0000original\\\";a:0:{}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}s:13:\\\"\\u0000*\\u0000foreignKey\\\";s:3:\\\"oid\\\";s:13:\\\"\\u0000*\\u0000relatedKey\\\";s:3:\\\"pid\\\";}}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}i:1;O:11:\\\"App\\\\Product\\\":26:{s:11:\\\"\\u0000*\\u0000fillable\\\";a:5:{i:0;s:4:\\\"name\\\";i:1;s:4:\\\"code\\\";i:2;s:5:\\\"stock\\\";i:3;s:3:\\\"uom\\\";i:4;s:5:\\\"price\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:8:\\\"products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:10:{s:2:\\\"id\\\";i:4;s:4:\\\"name\\\";s:14:\\\"Pakistani Lawn\\\";s:4:\\\"code\\\";s:7:\\\"PL-3094\\\";s:5:\\\"stock\\\";i:565;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1990;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:28:31\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:15:{s:2:\\\"id\\\";i:4;s:4:\\\"name\\\";s:14:\\\"Pakistani Lawn\\\";s:4:\\\"code\\\";s:7:\\\"PL-3094\\\";s:5:\\\"stock\\\";i:565;s:3:\\\"uom\\\";s:3:\\\"set\\\";s:5:\\\"price\\\";d:1990;s:7:\\\"shop_id\\\";i:1;s:5:\\\"state\\\";i:1;s:10:\\\"created_at\\\";s:19:\\\"2020-06-13 23:28:31\\\";s:10:\\\"updated_at\\\";s:19:\\\"2020-06-18 02:38:11\\\";s:9:\\\"pivot_oid\\\";i:10;s:9:\\\"pivot_pid\\\";i:4;s:14:\\\"pivot_quantity\\\";i:3;s:11:\\\"pivot_price\\\";i:1990;s:14:\\\"pivot_discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:1:{s:5:\\\"pivot\\\";O:44:\\\"Illuminate\\\\Database\\\\Eloquent\\\\Relations\\\\Pivot\\\":29:{s:12:\\\"incrementing\\\";b:0;s:10:\\\"\\u0000*\\u0000guarded\\\";a:0:{}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:8:\\\"\\u0000*\\u0000table\\\";s:16:\\\"ordered_products\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:5:{s:3:\\\"oid\\\";i:10;s:3:\\\"pid\\\";i:4;s:8:\\\"quantity\\\";i:3;s:5:\\\"price\\\";i:1990;s:8:\\\"discount\\\";d:0;}s:11:\\\"\\u0000*\\u0000original\\\";a:5:{s:3:\\\"oid\\\";i:10;s:3:\\\"pid\\\";i:4;s:8:\\\"quantity\\\";i:3;s:5:\\\"price\\\";i:1990;s:8:\\\"discount\\\";d:0;}s:10:\\\"\\u0000*\\u0000changes\\\";a:0:{}s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:11:\\\"pivotParent\\\";r:147;s:13:\\\"\\u0000*\\u0000foreignKey\\\";s:3:\\\"oid\\\";s:13:\\\"\\u0000*\\u0000relatedKey\\\";s:3:\\\"pid\\\";}}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}}}}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}}s:31:\\\"\\u0000App\\\\Bot\\\\Receipt\\u0000total_discount\\\";i:0;}s:35:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000common\\\";O:14:\\\"App\\\\Bot\\\\Common\\\":0:{}s:41:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000text_message\\\";O:20:\\\"App\\\\Bot\\\\TextMessages\\\":1:{s:33:\\\"\\u0000App\\\\Bot\\\\TextMessages\\u0000recipientId\\\";s:16:\\\"2723987454293264\\\";}s:39:\\\"\\u0000App\\\\Jobs\\\\Bot\\\\ReceiptHandler\\u0000order_data\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:9:\\\"App\\\\Order\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:1:{i:0;s:16:\\\"ordered_products\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2020-06-18 02:38:12.694726\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:10:\\\"Asia\\/Dhaka\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Trying to get property \'order_code\' of non-object in F:\\xampp\\htdocs\\Bot\\app\\Jobs\\Bot\\ReceiptHandler.php:33\nStack trace:\n#0 F:\\xampp\\htdocs\\Bot\\app\\Jobs\\Bot\\ReceiptHandler.php(33): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Trying to get p...\', \'F:\\\\xampp\\\\htdocs...\', 33, Array)\n#1 [internal function]: App\\Jobs\\Bot\\ReceiptHandler->handle()\n#2 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#3 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(36): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#4 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#5 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#6 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#7 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(94): Illuminate\\Container\\Container->call(Array)\n#8 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(130): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#9 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#10 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(98): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#11 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(83): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\Bot\\ReceiptHandler), false)\n#12 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(130): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#13 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(105): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\Bot\\ReceiptHandler))\n#14 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(85): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#15 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(59): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\Bot\\ReceiptHandler))\n#16 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(88): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#17 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(368): Illuminate\\Queue\\Jobs\\Job->fire()\n#18 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(314): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#19 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(267): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(112): Illuminate\\Queue\\Worker->runNextJob(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#21 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(96): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#22 [internal function]: Illuminate\\Queue\\Console\\WorkCommand->handle()\n#23 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(32): call_user_func_array(Array, Array)\n#24 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(36): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#25 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(90): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#26 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(34): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#27 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(590): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#28 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(134): Illuminate\\Container\\Container->call(Array)\n#29 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Command\\Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#30 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#31 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(1001): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(271): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 F:\\xampp\\htdocs\\Bot\\vendor\\symfony\\console\\Application.php(147): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 F:\\xampp\\htdocs\\Bot\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(131): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#36 F:\\xampp\\htdocs\\Bot\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 {main}', '2020-06-17 20:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` tinyint(4) DEFAULT NULL,
  `shop_id` smallint(6) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `prefix`, `route_name`, `parent_id`, `shop_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', NULL, 'dashboard.show', NULL, 1, 1, '2020-06-14 18:00:00', NULL),
(2, 'Manage Products', NULL, NULL, NULL, 1, 1, NULL, NULL),
(3, 'Add Product', 'product', 'product.add.view', 2, 1, 1, NULL, NULL),
(4, 'Product Lists', 'product', 'product.manage.view', 2, 1, 1, NULL, NULL),
(5, 'Manage Discount', NULL, NULL, NULL, 1, 1, NULL, NULL),
(6, 'Add Discounts', 'discount', 'discount.add.view', 5, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_user_role_mappings_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_03_02_091514_create_jobs_table', 1),
(6, '2020_03_18_085002_create_customers_table', 1),
(8, '2020_03_23_074602_create_products_table', 1),
(9, '2020_03_23_074623_create_product_images_table', 1),
(10, '2020_03_23_074958_create_cart_table', 1),
(11, '2020_03_23_074958_create_discounts_table', 1),
(13, '2020_05_24_053816_create_sessions_table', 1),
(15, '2020_06_12_194245_create_shops_table', 1),
(17, '2020_06_12_203036_create_customers_shops_table', 1),
(19, '2020_03_23_074958_create_pre_orders_table', 2),
(21, '2020_06_15_124153_create_menus_table', 3),
(22, '2020_06_09_205600_create_roles_table', 4),
(23, '2020_06_15_124736_create_role_menu_mappings_table', 4),
(24, '2020_03_19_094454_create_orders_table', 5),
(25, '2020_06_12_194702_create_ordered_products_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oid` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `additional_product_details` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `oid`, `pid`, `quantity`, `price`, `discount`, `additional_product_details`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 8, 3, 1, 1350, 0, NULL, 1, '2020-06-17 19:20:43', '2020-06-17 19:20:43'),
(2, 8, 1, 1, 28900, 0, NULL, 1, '2020-06-17 19:20:43', '2020-06-17 19:20:43'),
(3, 9, 3, 1, 1350, 0, NULL, 0, '2020-06-17 20:36:42', '2020-06-17 20:36:42'),
(4, 9, 4, 1, 1990, 0, NULL, 0, '2020-06-17 20:36:42', '2020-06-17 20:36:42'),
(5, 10, 3, 4, 1350, 0, NULL, 0, '2020-06-17 20:38:11', '2020-06-17 20:38:11'),
(6, 10, 4, 3, 1990, 0, NULL, 0, '2020-06-17 20:38:11', '2020-06-17 20:38:11'),
(7, 11, 3, 2, 1350, 0, NULL, 0, '2020-06-17 20:40:18', '2020-06-17 20:40:18'),
(8, 11, 4, 3, 1990, 0, NULL, 0, '2020-06-17 20:40:18', '2020-06-17 20:40:18'),
(9, 11, 1, 2, 28900, 0, NULL, 0, '2020-06-17 20:40:18', '2020-06-17 20:40:18'),
(10, 11, 2, 2, 50000, 0, NULL, 0, '2020-06-17 20:40:18', '2020-06-17 20:40:18'),
(11, 12, 3, 2, 1350, 0, NULL, 0, '2020-06-17 20:47:33', '2020-06-17 20:47:33'),
(12, 12, 4, 2, 1990, 0, NULL, 0, '2020-06-17 20:47:33', '2020-06-17 20:47:33'),
(13, 13, 3, 2, 1350, 0, NULL, 0, '2020-06-17 20:49:33', '2020-06-17 20:49:33'),
(14, 13, 4, 2, 1990, 0, NULL, 0, '2020-06-17 20:49:33', '2020-06-17 20:49:33'),
(15, 13, 1, 2, 28900, 0, NULL, 0, '2020-06-17 20:49:33', '2020-06-17 20:49:33'),
(16, 13, 2, 2, 50000, 0, NULL, 0, '2020-06-17 20:49:33', '2020-06-17 20:49:33'),
(17, 14, 1, 1, 28900, 0, NULL, 0, '2020-06-17 20:50:50', '2020-06-17 20:50:50'),
(18, 14, 5, 3, 3000, 0, NULL, 0, '2020-06-17 20:50:50', '2020-06-17 20:50:50'),
(19, 14, 6, 2, 3400, 0, NULL, 0, '2020-06-17 20:50:50', '2020-06-17 20:50:50'),
(20, 15, 3, 2, 1350, 0, NULL, 0, '2020-06-17 20:52:54', '2020-06-17 20:52:54'),
(21, 15, 5, 2, 3000, 0, NULL, 0, '2020-06-17 20:52:54', '2020-06-17 20:52:54'),
(22, 16, 5, 1, 3000, 0, NULL, 0, '2020-06-17 20:53:54', '2020-06-17 20:53:54'),
(23, 16, 6, 1, 3400, 0, NULL, 0, '2020-06-17 20:53:54', '2020-06-17 20:53:54'),
(24, 16, 4, 1, 1990, 0, NULL, 0, '2020-06-17 20:53:54', '2020-06-17 20:53:54'),
(25, 17, 3, 1, 1350, 0, NULL, 0, '2020-06-17 20:54:28', '2020-06-17 20:54:28'),
(26, 18, 3, 1, 1350, 0, NULL, 0, '2020-06-17 21:21:59', '2020-06-17 21:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `billing_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_order_details` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT 0,
  `status_updated_by` int(11) DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `customer_name`, `customer_id`, `billing_address`, `shipping_address`, `contact`, `additional_order_details`, `order_status`, `status_updated_by`, `shop_id`, `created_at`, `updated_at`) VALUES
(8, '1592421643_26395', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725787', NULL, 0, NULL, 1, '2020-06-17 19:20:43', '2020-06-17 19:20:43'),
(9, '1592426202_85872', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:36:42', '2020-06-17 20:36:42'),
(10, '1592426291_52495', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:38:11', '2020-06-17 20:38:11'),
(11, '1592426418_2734', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:40:18', '2020-06-17 20:40:18'),
(12, '1592426853_25753', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:47:33', '2020-06-17 20:47:33'),
(13, '1592426973_41054', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:49:33', '2020-06-17 20:49:33'),
(14, '1592427050_5401', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:50:50', '2020-06-17 20:50:50'),
(15, '1592427174_35033', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:52:54', '2020-06-17 20:52:54'),
(16, '1592427234_11425', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:53:54', '2020-06-17 20:53:54'),
(17, '1592427267_95282', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 20:54:27', '2020-06-17 20:54:27'),
(18, '1592428919_47261', 'Mehedi Sonet', 1, 'Mollapara, Taltola, West Agargaon, Dhaka', 'Mollapara, Taltola, West Agargaon, Dhaka', '01707725788', NULL, 0, NULL, 1, '2020-06-17 21:21:59', '2020-06-17 21:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_orders`
--

CREATE TABLE `pre_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_fb_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_product_details` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` mediumint(9) NOT NULL DEFAULT 0,
  `uom` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `stock`, `uom`, `price`, `shop_id`, `state`, `image`, `created_at`, `updated_at`) VALUES
(1, 'TAG HEUER Watch', 'TH-2003', 94, 'pcs', 28900.00, 1, 1, 'shop_1/TH-2003_1.jpeg', '2020-06-13 17:22:32', '2020-06-17 20:50:50'),
(2, 'ROLEX Watch', 'RX-3998', 34, 'pcs', 50000.00, 1, 1, 'shop_1/RX-3998_1.jpeg', '2020-06-13 17:23:58', '2020-06-17 20:49:33'),
(3, 'Pakistani Three Piece', 'PTP-30928', 984, 'set', 1350.00, 1, 1, 'shop_1/PTP-3092_1.jpeg', '2020-06-13 17:26:40', '2020-06-17 21:21:59'),
(4, 'Pakistani Lawn', 'PL-3094', 557, 'set', 1990.00, 1, 1, 'shop_1/PL-3094_1.jpeg', '2020-06-13 17:28:31', '2020-06-17 20:53:54'),
(5, 'Jamdani Saree Red', 'JS-1001', 494, 'pcs', 3000.00, 1, 1, 'shop_1/JS-1001_1.jpeg', '2020-06-13 17:30:16', '2020-06-17 20:53:54'),
(6, 'Jamdani Saree Yellow', 'JSY-1002', 47, 'pcs', 3400.00, 1, 1, 'shop_1/JSY-1002_1.jpeg', '2020-06-13 17:31:34', '2020-06-17 20:53:54'),
(7, 'Hijab', 'H-100', 1000, 'pcs', 276.00, 1, 1, 'shop_1/H-100_1.jpeg', '2020-06-14 18:28:13', '2020-06-14 18:28:13'),
(8, 'Pakistani Gulji', 'PG-2001', 900, 'set', 473.00, 2, 1, 'shop_1/PG-2001_1.jpeg', '2020-06-17 15:54:24', '2020-06-17 15:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pid` int(11) NOT NULL,
  `image_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `pid`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'shop_1/TH-2003_1.jpeg', '2020-06-13 17:22:33', '2020-06-13 17:22:33'),
(2, 1, 'shop_1/TH-2003_2.jpeg', '2020-06-13 17:22:33', '2020-06-13 19:01:21'),
(3, 2, 'shop_1/TH-2003_2.jpeg', '2020-06-13 17:23:58', '2020-06-13 19:00:15'),
(4, 2, 'shop_1/RX-3998_1.jpeg', '2020-06-13 17:23:58', '2020-06-13 17:23:58'),
(5, 3, 'shop_1/PTP-3092_1.jpeg', '2020-06-13 17:26:40', '2020-06-13 17:26:40'),
(6, 3, 'shop_1/PTP-30928_2.jpeg', '2020-06-13 17:26:40', '2020-06-17 16:24:35'),
(7, 4, 'shop_1/PL-3094_1.jpeg', '2020-06-13 17:28:31', '2020-06-13 17:28:31'),
(8, 4, 'shop_1/PL-3094_2.jpeg', '2020-06-13 17:28:31', '2020-06-17 16:24:55'),
(9, 5, 'shop_1/JS-1001_1.jpeg', '2020-06-13 17:30:17', '2020-06-13 17:30:17'),
(10, 5, 'shop_1/JS-1001_1.jpeg', '2020-06-13 17:30:17', '2020-06-13 17:30:17'),
(11, 6, 'shop_1/JSY-1002_1.jpeg', '2020-06-13 17:31:34', '2020-06-13 17:31:34'),
(12, 6, 'shop_1/JSY-1002_1.jpeg', '2020-06-13 17:31:34', '2020-06-13 17:31:34'),
(13, 7, 'shop_1/H-100_1.jpeg', '2020-06-14 18:28:13', '2020-06-14 18:28:13'),
(14, 7, 'shop_1/H-100_2.jpeg', '2020-06-14 18:37:51', '2020-06-14 18:37:51'),
(15, 8, 'shop_1/PG-2001_1.jpeg', '2020-06-17 15:54:24', '2020-06-17 15:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `shop_id`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_menu_mappings`
--

CREATE TABLE `role_menu_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_menu_mappings`
--

INSERT INTO `role_menu_mappings` (`id`, `menu_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `shop_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_web_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_unique_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `shop_name`, `shop_contact`, `shop_address`, `shop_web_link`, `shop_unique_id`, `owner_name`, `owner_contact`, `created_at`, `updated_at`) VALUES
(1, 'Demo Shop', '01987266334', 'Some address', 'https://www.facebook.com/demosgbot/', 'dm-1001', 'Sayla', '0198262534', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` smallint(6) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `shop_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Sonnet', 'sonnet', '12345', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_mappings`
--

CREATE TABLE `user_role_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role_mappings`
--

INSERT INTO `user_role_mappings` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_shops`
--
ALTER TABLE `customers_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pre_orders`
--
ALTER TABLE `pre_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_menu_mappings`
--
ALTER TABLE `role_menu_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_role_mappings`
--
ALTER TABLE `user_role_mappings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers_shops`
--
ALTER TABLE `customers_shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pre_orders`
--
ALTER TABLE `pre_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_menu_mappings`
--
ALTER TABLE `role_menu_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role_mappings`
--
ALTER TABLE `user_role_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
