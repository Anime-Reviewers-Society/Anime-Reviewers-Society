<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701195207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE anime CHANGE target_id target_id INT DEFAULT NULL, CHANGE translated_title translated_title VARCHAR(255) DEFAULT NULL, CHANGE release_date release_date DATETIME DEFAULT NULL, CHANGE opening opening VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE author_id author_id INT DEFAULT NULL, CHANGE anime_id anime_id INT DEFAULT NULL, CHANGE vote vote INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE icone icone VARCHAR(255) DEFAULT NULL, CHANGE color color VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE anime CHANGE target_id target_id INT DEFAULT NULL, CHANGE translated_title translated_title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE release_date release_date DATETIME DEFAULT \'NULL\', CHANGE opening opening VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE review CHANGE author_id author_id INT DEFAULT NULL, CHANGE anime_id anime_id INT DEFAULT NULL, CHANGE vote vote INT NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE icone icone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE color color VARCHAR(10) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
