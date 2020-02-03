<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200130155149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prices DROP FOREIGN KEY FK_E4CB6D599C24126');
        $this->addSql('DROP TABLE prices_day');
        $this->addSql('DROP INDEX IDX_E4CB6D599C24126 ON prices');
        $this->addSql('ALTER TABLE prices DROP day_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prices_day (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, active INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prices ADD day_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT FK_E4CB6D599C24126 FOREIGN KEY (day_id) REFERENCES prices_day (id)');
        $this->addSql('CREATE INDEX IDX_E4CB6D599C24126 ON prices (day_id)');
    }
}
