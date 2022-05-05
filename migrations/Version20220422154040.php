<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422154040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement RENAME INDEX fk_23a0e66cbaaaab3 TO FK_7CE748AA76ED354');
        $this->addSql('ALTER TABLE evenement RENAME INDEX fk_23a0e66cbaaaab4 TO FK_7CE748AA76ED358');
        $this->addSql('ALTER TABLE like_evt CHANGE id_evt id_evt INT DEFAULT NULL, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation CHANGE id_evt id_evt INT DEFAULT NULL, CHANGE id_user id_user INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement RENAME INDEX fk_7ce748aa76ed354 TO FK_23A0E66CBAAAAB3');
        $this->addSql('ALTER TABLE evenement RENAME INDEX fk_7ce748aa76ed358 TO FK_23A0E66CBAAAAB4');
        $this->addSql('ALTER TABLE like_evt CHANGE id_user id_user INT NOT NULL, CHANGE id_evt id_evt INT NOT NULL');
        $this->addSql('ALTER TABLE participation CHANGE id_user id_user INT NOT NULL, CHANGE id_evt id_evt INT NOT NULL');
    }
}
