<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422062644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorieevt (id_categorie INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id_categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id_evt INT AUTO_INCREMENT NOT NULL, id_photo INT DEFAULT NULL, id_categorie INT DEFAULT NULL, nom_evt VARCHAR(255) NOT NULL, description_evt TEXT NOT NULL, date_evt DATE NOT NULL, heure_evt TIME NOT NULL, lieu_evt TEXT NOT NULL, responsable VARCHAR(255) NOT NULL, places INT NOT NULL, INDEX FK_23A0E66CBAAAAB3 (id_photo), INDEX FK_23A0E66CBAAAAB4 (id_categorie), PRIMARY KEY(id_evt)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE like_evt (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id_photo INT AUTO_INCREMENT NOT NULL, image BLOB NOT NULL, PRIMARY KEY(id_photo)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, telephone INT NOT NULL, is_blocked TINYINT(1) NOT NULL, solde DOUBLE PRECISION NOT NULL, usertype VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EFA32C528 FOREIGN KEY (id_photo) REFERENCES photos (id_photo)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EC9486A13 FOREIGN KEY (id_categorie) REFERENCES categorieevt (id_categorie)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EC9486A13');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EFA32C528');
        $this->addSql('DROP TABLE categorieevt');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE like_evt');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE utilisateur');
    }
}
