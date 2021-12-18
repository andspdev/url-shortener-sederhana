CREATE TABLE IF NOT EXISTS `shortener` (
    `id` int NOT NULL AUTO_INCREMENT,
    `url` varchar(500) NOT NULL,
    `kode` varchar(8) NOT NULL,
    `tanggal_buat` datetime NOT NULL,
    UNIQUE(`kode`),
    PRIMARY KEY (`id`)
);