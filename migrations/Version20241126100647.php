<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126100647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, title VARCHAR(255) NOT NULL, duration INT NOT NULL, released_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DDAA1CDA4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_history_user DROP FOREIGN KEY FK_E8F0BAA2A76ED395');
        $this->addSql('ALTER TABLE subscription_history_user DROP FOREIGN KEY FK_E8F0BAA2DCE0C437');
        $this->addSql('DROP TABLE subscription_history_user');
        $this->addSql('ALTER TABLE category CHANGE name nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE language CHANGE code code VARCHAR(3) NOT NULL, CHANGE name nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE media ADD discr VARCHAR(255) NOT NULL, CHANGE long_description long_description LONGTEXT NOT NULL, CHANGE cast casting JSON NOT NULL');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DA76ED395');
        $this->addSql('DROP INDEX UNIQ_D782112DA76ED395 ON playlist');
        $this->addSql('ALTER TABLE playlist CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE user_id creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_D782112D61220EA6 ON playlist (creator_id)');
        $this->addSql('ALTER TABLE playlist_media CHANGE added_at added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940CA76ED395');
        $this->addSql('DROP INDEX IDX_832940CA76ED395 ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE subscribed_at subscribed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE user_id subscriber_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C7808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_832940C7808B1AD ON playlist_subscription (subscriber_id)');
        $this->addSql('ALTER TABLE season ADD number VARCHAR(255) NOT NULL, CHANGE season_number serie_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_F0E45BA9D94388BD ON season (serie_id)');
        $this->addSql('ALTER TABLE serie CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334BF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_history ADD subscriber_id INT NOT NULL, ADD start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP start_date, DROP end_date');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D07808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_54AF90D07808B1AD ON subscription_history (subscriber_id)');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8A76ED395');
        $this->addSql('DROP INDEX IDX_DE44EFD8A76ED395 ON watch_history');
        $this->addSql('ALTER TABLE watch_history ADD last_watched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP last_watched, CHANGE user_id watcher_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8C300AB5D FOREIGN KEY (watcher_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8C300AB5D ON watch_history (watcher_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subscription_history_user (subscription_history_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E8F0BAA2DCE0C437 (subscription_history_id), INDEX IDX_E8F0BAA2A76ED395 (user_id), PRIMARY KEY(subscription_history_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE subscription_history_user ADD CONSTRAINT FK_E8F0BAA2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_history_user ADD CONSTRAINT FK_E8F0BAA2DCE0C437 FOREIGN KEY (subscription_history_id) REFERENCES subscription_history (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FBF396750');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE movie');
        $this->addSql('ALTER TABLE category CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334BF396750');
        $this->addSql('ALTER TABLE serie CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('DROP INDEX IDX_F0E45BA9D94388BD ON season');
        $this->addSql('ALTER TABLE season DROP number, CHANGE serie_id season_number INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D07808B1AD');
        $this->addSql('DROP INDEX IDX_54AF90D07808B1AD ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL, DROP subscriber_id, DROP start_at, DROP end_at');
        $this->addSql('ALTER TABLE playlist_media CHANGE added_at added_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C7808B1AD');
        $this->addSql('DROP INDEX IDX_832940C7808B1AD ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE subscribed_at subscribed_at DATETIME NOT NULL, CHANGE subscriber_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_832940CA76ED395 ON playlist_subscription (user_id)');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D61220EA6');
        $this->addSql('DROP INDEX IDX_D782112D61220EA6 ON playlist');
        $this->addSql('ALTER TABLE playlist CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE creator_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D782112DA76ED395 ON playlist (user_id)');
        $this->addSql('ALTER TABLE language CHANGE code code VARCHAR(255) NOT NULL, CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8C300AB5D');
        $this->addSql('DROP INDEX IDX_DE44EFD8C300AB5D ON watch_history');
        $this->addSql('ALTER TABLE watch_history ADD last_watched DATETIME NOT NULL, DROP last_watched_at, CHANGE watcher_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DE44EFD8A76ED395 ON watch_history (user_id)');
        $this->addSql('ALTER TABLE media DROP discr, CHANGE long_description long_description LONGTEXT DEFAULT NULL, CHANGE casting cast JSON NOT NULL');
    }
}
