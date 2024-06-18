USE finanzas_personales;

CREATE TABLE Withdrawals
(
    id             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    payment_method TINYINT         NOT NULL,
    type           TINYINT         NOT NULL,
    date           TIMESTAMP       NOT NULL,
    amount         FLOAT           NOT NULL,
    description    TEXT            NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE incomes
(
    id             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    payment_method TINYINT         NOT NULL,
    type           TINYINT         NOT NULL,
    date           TIMESTAMP       NOT NULL,
    amount         FLOAT           NOT NULL,
    description    TEXT            NOT NULL,
    PRIMARY KEY (id)
);
