CREATE DATABASE `fiap_secretariat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_document_unique` (`document`),
  UNIQUE KEY `student_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `class_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`student_id`,`class_id`),
  KEY `fk_registration_student` (`student_id`),
  KEY `fk_registration_class` (`class_id`),
  CONSTRAINT `fk_registration_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `fk_registration_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `students` VALUES (12,'Gustavo Passos','51530900867','2000-10-15','gpassosdelima@gmail.com','$2y$10$8rTAyBkL3fKtgQBFWdlH6OOo3iR4QXULflIu8cWuffbLZtkzBu0ZO','2025-04-16 18:38:39','2025-04-17 13:16:21'),(13,'Amanda Silva','12345678901','1990-05-15','amanda.silva@example.com','$2y$10$abc123amandaSilvaHash','2024-01-12 10:30:00','2024-01-12 10:30:00'),(14,'Bruno Martins','23456789012','1988-07-22','bruno.martins@example.com','$2y$10$abc123brunoMartinsHash','2024-01-15 14:10:00','2024-01-15 14:10:00'),(15,'Camila Rocha','34567890123','1995-02-03','camila.rocha@example.com','$2y$10$abc123camilaRochaHash','2024-01-17 08:55:00','2024-01-17 08:55:00'),(16,'Daniel Souza','45678901234','1985-11-30','daniel.souza@example.com','$2y$10$abc123danielSouzaHash','2024-01-20 09:40:00','2024-01-20 09:40:00'),(17,'Eduarda Lima','56789012345','1992-03-18','eduarda.lima@example.com','$2y$10$abc123eduardaLimaHash','2024-01-22 13:15:00','2024-01-22 13:15:00'),(18,'Felipe Costa','67890123456','1991-08-10','felipe.costa@example.com','$2y$10$abc123felipeCostaHash','2024-01-23 11:25:00','2024-01-23 11:25:00'),(19,'Gabriela Nunes','78901234567','1998-12-04','gabriela.nunes@example.com','$2y$10$abc123gabrielaNunesHash','2024-01-24 15:50:00','2024-01-24 15:50:00'),(20,'Henrique Almeida','89012345678','1989-04-28','henrique.almeida@example.com','$2y$10$abc123henriqueAlmeidaHash','2024-01-25 10:10:00','2024-01-25 10:10:00'),(21,'Isabela Fernandes','90123456789','1996-06-19','isabela.fernandes@example.com','$2y$10$abc123isabelaFernandesHash','2024-01-26 12:05:00','2024-01-26 12:05:00'),(22,'João Ribeiro','01234567890','1993-01-11','joao.ribeiro@example.com','$2y$10$abc123joaoRibeiroHash','2024-01-27 14:40:00','2024-01-27 14:40:00'),(23,'Karina Moraes','13579246801','1994-09-25','karina.moraes@example.com','$2y$10$abc123karinaMoraesHash','2024-01-28 17:00:00','2024-01-28 17:00:00'),(24,'Lucas Teixeira','24681357902','1987-10-13','lucas.teixeira@example.com','$2y$10$abc123lucasTeixeiraHash','2024-01-29 08:20:00','2024-01-29 08:20:00'),(25,'Marina Gonçalves','35792468013','2000-02-26','marina.goncalves@example.com','$2y$10$abc123marinaGoncalvesHash','2024-01-30 13:35:00','2024-01-30 13:35:00'),(26,'Nathan Oliveira','46803579124','1999-07-09','nathan.oliveira@example.com','$2y$10$abc123nathanOliveiraHash','2024-01-31 09:15:00','2024-01-31 09:15:00'),(27,'Olivia Freitas','57914680235','1997-04-01','olivia.freitas@example.com','$2y$10$abc123oliviaFreitasHash','2024-02-01 16:00:00','2024-02-01 16:00:00'),(28,'Paulo Henrique','68025791346','1990-12-21','paulo.henrique@example.com','$2y$10$abc123pauloHenriqueHash','2024-02-02 11:10:00','2024-02-02 11:10:00'),(29,'Quezia Dias','79136802457','1993-08-07','quezia.dias@example.com','$2y$10$abc123queziaDiasHash','2024-02-03 14:45:00','2024-02-03 14:45:00'),(30,'Rafael Torres','80247913568','1986-06-16','rafael.torres@example.com','$2y$10$abc123rafaelTorresHash','2024-02-04 13:00:00','2024-02-04 13:00:00'),(31,'Sara Martins','91358024679','1995-03-30','sara.martins@example.com','$2y$10$abc123saraMartinsHash','2024-02-05 15:25:00','2024-02-05 15:25:00'),(32,'Tiago Barros','02469135780','1984-11-03','tiago.barros@example.com','$2y$10$abc123tiagoBarrosHash','2024-02-06 10:50:00','2024-02-06 10:50:00');

INSERT INTO `classes` VALUES (2,'Sistemas de informação','Curso de sistemas de informação período verspertino.	','2025-04-17 17:22:40','2025-04-17 17:22:40'),(3,'Análise e Desenvolvimento de sistemas','Análise e Desenvolvimento de sistemas período Matutino','2025-04-17 21:10:53','2025-04-17 21:10:53');

INSERT INTO `registrations` VALUES (2,13,2,'2025-04-17 19:34:00','2025-04-17 19:34:00'),(4,16,2,'2025-04-17 19:34:00','2025-04-17 19:34:00'),(5,17,2,'2025-04-17 19:34:00','2025-04-17 19:34:00'),(6,19,2,'2025-04-17 19:34:00','2025-04-17 19:34:00'),(7,12,2,'2025-04-17 19:34:00','2025-04-17 19:34:00'),(9,30,2,'2025-04-17 20:42:14','2025-04-17 20:42:14'),(10,31,2,'2025-04-17 20:42:14','2025-04-17 20:42:14'),(11,15,2,'2025-04-17 20:42:14','2025-04-17 20:42:14'),(15,29,2,'2025-04-17 20:42:31','2025-04-17 20:42:31'),(16,27,2,'2025-04-17 20:42:31','2025-04-17 20:42:31'),(17,13,3,'2025-04-17 21:11:11','2025-04-17 21:11:11'),(18,15,3,'2025-04-17 21:11:11','2025-04-17 21:11:11'),(19,16,3,'2025-04-17 21:11:11','2025-04-17 21:11:11');

INSERT INTO `users` (`name`,`email`,`password`,`created_at`,`updated_at`) VALUES ('admin', 'admin@admin.com', '$2y$10$810/QeZYf.zewN7p93Uyz.lUwBQ/CdvewsqkEaGUSFa4b1NYdMu9e', '2025-04-18 09:11:00', '2025-04-18 09:11:00');