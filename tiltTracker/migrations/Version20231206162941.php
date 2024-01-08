<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206162941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DCA3348D6');
        $this->addSql('DROP INDEX UNIQ_59B1F3DCA3348D6 ON partie');
        $this->addSql('ALTER TABLE partie CHANGE user_match_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_59B1F3DA76ED395 ON partie (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DA76ED395');
        $this->addSql('DROP INDEX IDX_59B1F3DA76ED395 ON partie');
        $this->addSql('ALTER TABLE partie CHANGE user_id user_match_id INT NOT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DCA3348D6 FOREIGN KEY (user_match_id) REFERENCES user_match (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59B1F3DCA3348D6 ON partie (user_match_id)');
    }
}
