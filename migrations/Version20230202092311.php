<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202092311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `member` ADD crew_id INT NOT NULL');
        $this->addSql('ALTER TABLE `member` ADD CONSTRAINT FK_70E4FA785FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA785FE259F6 ON `member` (crew_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `member` DROP FOREIGN KEY FK_70E4FA785FE259F6');
        $this->addSql('DROP INDEX IDX_70E4FA785FE259F6 ON `member`');
        $this->addSql('ALTER TABLE `member` DROP crew_id');
    }
}
