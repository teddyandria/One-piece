<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201173535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE members ADD crew_id INT NOT NULL');
        $this->addSql('ALTER TABLE members ADD CONSTRAINT FK_45A0D2FF5FE259F6 FOREIGN KEY (crew_id) REFERENCES crew (id)');
        $this->addSql('CREATE INDEX IDX_45A0D2FF5FE259F6 ON members (crew_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE members DROP FOREIGN KEY FK_45A0D2FF5FE259F6');
        $this->addSql('DROP INDEX IDX_45A0D2FF5FE259F6 ON members');
        $this->addSql('ALTER TABLE members DROP crew_id');
    }
}
