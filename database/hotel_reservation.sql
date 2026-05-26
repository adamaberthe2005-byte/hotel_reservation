-- ============================================
-- BASE DE DONNÉES : hotel_reservation
-- Système de Réservation Hôtelière
-- ============================================

CREATE DATABASE IF NOT EXISTS hotel_reservation
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE hotel_reservation;

-- ============================================
-- TABLE 1 : CLIENT
-- ============================================
CREATE TABLE IF NOT EXISTS CLIENT (
    num_cli     INT AUTO_INCREMENT PRIMARY KEY,
    nom_cli     VARCHAR(30)   NOT NULL,
    prenom_cli  VARCHAR(30)   NOT NULL,
    tel_cli     VARCHAR(15),
    email_cli   VARCHAR(50),
    mdp_cli     VARCHAR(255)  NOT NULL
);

-- ============================================
-- TABLE 2 : HOTEL
-- ============================================
CREATE TABLE IF NOT EXISTS HOTEL (
    num_hot     INT AUTO_INCREMENT PRIMARY KEY,
    nom_hot     VARCHAR(50)   NOT NULL,
    categorie   VARCHAR(5)    NOT NULL,
    ville       VARCHAR(50)   NOT NULL
);

-- ============================================
-- TABLE 3 : CHAMBRE (dépend de HOTEL)
-- ============================================
CREATE TABLE IF NOT EXISTS CHAMBRE (
    num_ch      INT AUTO_INCREMENT PRIMARY KEY,
    type_ch     VARCHAR(20)   NOT NULL,
    prix_ch     DECIMAL(10,2) NOT NULL,
    num_hot     INT           NOT NULL,
    FOREIGN KEY (num_hot) REFERENCES HOTEL(num_hot)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- ============================================
-- TABLE 4 : RESERVATION (dépend de CLIENT)
-- ============================================
CREATE TABLE IF NOT EXISTS RESERVATION (
    num_res     INT AUTO_INCREMENT PRIMARY KEY,
    date_deb    DATE          NOT NULL,
    date_fin    DATE          NOT NULL,
    num_cli     INT           NOT NULL,
    FOREIGN KEY (num_cli) REFERENCES CLIENT(num_cli)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- ============================================
-- TABLE 5 : LIGNE_RESERVATION (liaison n,n)
-- ============================================
CREATE TABLE IF NOT EXISTS LIGNE_RESERVATION (
    num_res     INT NOT NULL,
    num_ch      INT NOT NULL,
    PRIMARY KEY (num_res, num_ch),
    FOREIGN KEY (num_res) REFERENCES RESERVATION(num_res)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (num_ch)  REFERENCES CHAMBRE(num_ch)
        ON DELETE CASCADE ON UPDATE CASCADE
);
