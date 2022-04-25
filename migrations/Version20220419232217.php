<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419232217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD categories_id INT DEFAULT NULL, ADD content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9A21214B7 FOREIGN KEY (categories_id) REFERENCES categorieprojet (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9A21214B7 ON projet (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9A21214B7');
        $this->addSql('DROP INDEX IDX_50159CA9A21214B7 ON projet');
        $this->addSql('ALTER TABLE projet DROP categories_id, DROP content');
    }
}
