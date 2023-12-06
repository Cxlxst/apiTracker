<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206112427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64979F37AE5');
        $this->addSql('DROP INDEX UNIQ_8D93D64979F37AE5 ON user');
        $this->addSql('ALTER TABLE user CHANGE id_user_id id_user_stats_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492E0F01E7 FOREIGN KEY (id_user_stats_id) REFERENCES user_match (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492E0F01E7 ON user (id_user_stats_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492E0F01E7');
        $this->addSql('DROP INDEX IDX_8D93D6492E0F01E7 ON user');
        $this->addSql('ALTER TABLE user CHANGE id_user_stats_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64979F37AE5 FOREIGN KEY (id_user_id) REFERENCES user_match (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64979F37AE5 ON user (id_user_id)');
    }
}
