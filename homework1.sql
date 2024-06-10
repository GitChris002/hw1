-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 10, 2024 alle 17:38
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homework1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE `iscrizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `tipo_abbonamento` varchar(255) DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggicontatto`
--

CREATE TABLE `messaggicontatto` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Messaggio` text DEFAULT NULL,
  `DataInserimento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qyRYuOsdTlENRe92myqdGEOzTynM0SUhAloSc43B', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6ImFIVHRqTE1sbjNmYm1LRzh4d2x3OVZpc0RKbEdjUThiNHZBeXVUZ1UiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZmV0Y2gtc29uZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjg6InVzZXJuYW1lIjtzOjY6IkVsc2ExNyI7czo2OiJnZW5lcmUiO3M6MToiRiI7czo4OiJuZXdfdXNlciI7YjoxO3M6NzoidXNlcl9pZCI7aToxOTtzOjQ6Im5vbWUiO3M6NDoiRWxzYSI7czo3OiJjb2dub21lIjtzOjQ6Ik1lbGkiO3M6ODoidGVsZWZvbm8iO3M6ODoiMTI0NTY3ODkiO3M6MTg6ImFscmVhZHlfc3Vic2NyaWJlZCI7YjowO30=', 1717962806);

-- --------------------------------------------------------

--
-- Struttura della tabella `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_id` varchar(255) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `songs`
--

INSERT INTO `songs` (`id`, `user_id`, `song_id`, `content`) VALUES
(46, 16, '5VZ0soW5syQfefCUj603DW', '{\"id\": \"5VZ0soW5syQfefCUj603DW\", \"title\": \"MASHA ULTRAFUNK\", \"artist\": \"HISTED\", \"duration\": \"93650\", \"popularity\": \"80\", \"image\": \"https://i.scdn.co/image/ab67616d0000b27393942466c2c6ec14557522c6\"}'),
(47, 16, '67smGwuPEtA6GAfeweAVNO', '{\"id\": \"67smGwuPEtA6GAfeweAVNO\", \"title\": \"SLAY!\", \"artist\": \"Eternxlkz\", \"duration\": \"107076\", \"popularity\": \"85\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273c80fe27586c2da910984cb9a\"}'),
(48, 16, '6yVjjQA31SLM1kc4j5jPwF', '{\"id\": \"6yVjjQA31SLM1kc4j5jPwF\", \"title\": \"BRAZILIAN DANÇA PHONK\", \"artist\": \"6YNTHMANE\", \"duration\": \"118194\", \"popularity\": \"78\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273c771f7401307f639d0272f68\"}'),
(49, 16, '7mLWNwcvwRdEviz6SfYp8A', '{\"id\": \"7mLWNwcvwRdEviz6SfYp8A\", \"title\": \"GigaChad Theme - Phonk House Version\", \"artist\": \"g3ox_em\", \"duration\": \"146274\", \"popularity\": \"75\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273ddff87d44e3d726372ef7f56\"}'),
(51, 16, '6qyS9qBy0mEk3qYaH8mPss', '{\"id\": \"6qyS9qBy0mEk3qYaH8mPss\", \"title\": \"Murder In My Mind\", \"artist\": \"Kordhell\", \"duration\": \"145000\", \"popularity\": \"80\", \"image\": \"https://i.scdn.co/image/ab67616d0000b2731440ffaa43c53d65719e0150\"}'),
(62, 16, '7BRD7x5pt8Lqa1eGYC4dzj', '{\"id\": \"7BRD7x5pt8Lqa1eGYC4dzj\", \"title\": \"CHIHIRO\", \"artist\": \"Billie Eilish\", \"duration\": \"303440\", \"popularity\": \"95\", \"image\": \"https://i.scdn.co/image/ab67616d0000b27371d62ea7ea8a5be92d3c1f62\"}'),
(63, 16, '5XYPTwya4YqPystALy9cLJ', '{\"id\": \"5XYPTwya4YqPystALy9cLJ\", \"title\": \"Bella ciao\", \"artist\": \"Fonola Band\", \"duration\": \"126613\", \"popularity\": \"60\", \"image\": \"https://i.scdn.co/image/ab67616d0000b2737094783b8bc993a5df553825\"}'),
(64, 16, '3Tou0MVSdIhJwYLgtKVJ2t', '{\"id\": \"3Tou0MVSdIhJwYLgtKVJ2t\", \"title\": \"Ciao\", \"artist\": \"kidrose\", \"duration\": \"167000\", \"popularity\": \"35\", \"image\": \"https://i.scdn.co/image/ab67616d0000b2732f31e63f07334d960b397480\"}'),
(65, 16, '06PqeO7IInus2yvzsZwZhf', '{\"id\": \"06PqeO7IInus2yvzsZwZhf\", \"title\": \"CUTE DEPRESSED\", \"artist\": \"Dyan Dxddy\", \"duration\": \"96946\", \"popularity\": \"82\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273550c08bd67e6d175e2dc463b\"}'),
(66, 16, '7aIb17DMLcOhLJIc9vF6Aa', '{\"id\": \"7aIb17DMLcOhLJIc9vF6Aa\", \"title\": \"Phonky Tribu\", \"artist\": \"Funk Tribu\", \"duration\": \"286145\", \"popularity\": \"62\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273c8e3aa03baa8787b55481109\"}'),
(67, 16, '2ksyzVfU0WJoBpu8otr4pz', '{\"id\": \"2ksyzVfU0WJoBpu8otr4pz\", \"title\": \"METAMORPHOSIS\", \"artist\": \"INTERWORLD\", \"duration\": \"142839\", \"popularity\": \"81\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273b852a616ae3a49a1f6b0f16e\"}'),
(68, 16, '4lxLioQ8YilK1QbF7FxGjZ', '{\"id\": \"4lxLioQ8YilK1QbF7FxGjZ\", \"title\": \"Phonk Up Brazil\", \"artist\": \"$werve\", \"duration\": \"90461\", \"popularity\": \"62\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273646037fd161b647e196dc2e3\"}'),
(69, 16, '1kZiI82AcevKgv7RCUiG3l', '{\"id\": \"1kZiI82AcevKgv7RCUiG3l\", \"title\": \"Funk of Galáctico\", \"artist\": \"SXID\", \"duration\": \"90461\", \"popularity\": \"74\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273361d4c29897bec6ef9a363b6\"}'),
(70, 16, '0Rhn6ADbLi4fPMsscGU2lM', '{\"id\": \"0Rhn6ADbLi4fPMsscGU2lM\", \"title\": \"Eu Sento E Me Acab\", \"artist\": \"MRL\", \"duration\": \"114466\", \"popularity\": \"27\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273ef72037ec9dca7581d026323\"}'),
(71, 16, '34lJpf1XeT6mS58S5Dwqn6', '{\"id\": \"34lJpf1XeT6mS58S5Dwqn6\", \"title\": \"Brazilian Phonk Mano - Super Slowed\", \"artist\": \"Slowboy\", \"duration\": \"106562\", \"popularity\": \"59\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273bd0055666367b3ec4e72b3f8\"}'),
(72, 16, '3Hb9kUdm4yf839Fle4RIdT', '{\"id\": \"3Hb9kUdm4yf839Fle4RIdT\", \"title\": \"Parado no Bailão\", \"artist\": \"MC L da Vinte\", \"duration\": \"171692\", \"popularity\": \"74\", \"image\": \"https://i.scdn.co/image/ab67616d0000b273b05904e1f9b5c426da85e098\"}'),
(73, 16, '0YThXX1dqUpYBLyJNAsF9N', '{\"id\": \"0YThXX1dqUpYBLyJNAsF9N\", \"title\": \"If We Being Rëal\", \"artist\": \"Yeat\", \"duration\": \"172500\", \"popularity\": \"85\", \"image\": \"https://i.scdn.co/image/ab67616d0000b2739567b80f50a5b9f0178ae993\"}'),
(74, 16, '2YSzYUF3jWqb9YP9VXmpjE', '{\"id\": \"2YSzYUF3jWqb9YP9VXmpjE\", \"title\": \"IDGAF (feat. Yeat)\", \"artist\": \"Drake\", \"duration\": \"260111\", \"popularity\": \"83\", \"image\": \"https://i.scdn.co/image/ab67616d0000b2737d384516b23347e92a587ed1\"}');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `genere` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`, `genere`, `nome`, `cognome`, `telefono`) VALUES
(16, 'ChristianV', '$2y$10$mwb6hl.hL0T0lK8i1yJumuG1izYg8MQylVA9mn0AZ26t9QW9kFmhy', 'M', 'Christian', 'Volpe', '3286628744');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indici per le tabelle `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indici per le tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indici per le tabelle `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indici per le tabelle `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `messaggicontatto`
--
ALTER TABLE `messaggicontatto`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indici per le tabelle `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT per la tabella `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `messaggicontatto`
--
ALTER TABLE `messaggicontatto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD CONSTRAINT `iscrizioni_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`);

--
-- Limiti per la tabella `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
