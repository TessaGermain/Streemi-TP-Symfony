<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002142617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subscription_history_user (subscription_history_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E8F0BAA2DCE0C437 (subscription_history_id), INDEX IDX_E8F0BAA2A76ED395 (user_id), PRIMARY KEY(subscription_history_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscription_history_user ADD CONSTRAINT FK_E8F0BAA2DCE0C437 FOREIGN KEY (subscription_history_id) REFERENCES subscription_history (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_history_user ADD CONSTRAINT FK_E8F0BAA2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_media ADD playlist_id INT NOT NULL, ADD media_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84F6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_C930B84F6BBD148 ON playlist_media (playlist_id)');
        $this->addSql('CREATE INDEX IDX_C930B84FEA9FDD75 ON playlist_media (media_id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD user_id INT NOT NULL, ADD playlist_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('CREATE INDEX IDX_832940CA76ED395 ON playlist_subscription (user_id)');
        $this->addSql('CREATE INDEX IDX_832940C6BBD148 ON playlist_subscription (playlist_id)');
        $this->addSql('ALTER TABLE subscription_history ADD subscription_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE INDEX IDX_54AF90D09A1887DC ON subscription_history (subscription_id)');
        $this->addSql('ALTER TABLE user ADD current_subscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DDE45DDE FOREIGN KEY (current_subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DDE45DDE ON user (current_subscription_id)');
        $this->addSql('ALTER TABLE watch_history ADD user_id INT NOT NULL, ADD media_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8A76ED395 ON watch_history (user_id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8EA9FDD75 ON watch_history (media_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription_history_user DROP FOREIGN KEY FK_E8F0BAA2DCE0C437');
        $this->addSql('ALTER TABLE subscription_history_user DROP FOREIGN KEY FK_E8F0BAA2A76ED395');
        $this->addSql('DROP TABLE subscription_history_user');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940CA76ED395');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('DROP INDEX IDX_832940CA76ED395 ON playlist_subscription');
        $this->addSql('DROP INDEX IDX_832940C6BBD148 ON playlist_subscription');
        $this->addSql('ALTER TABLE playlist_subscription DROP user_id, DROP playlist_id');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84F6BBD148');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84FEA9FDD75');
        $this->addSql('DROP INDEX IDX_C930B84F6BBD148 ON playlist_media');
        $this->addSql('DROP INDEX IDX_C930B84FEA9FDD75 ON playlist_media');
        $this->addSql('ALTER TABLE playlist_media DROP playlist_id, DROP media_id');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09A1887DC');
        $this->addSql('DROP INDEX IDX_54AF90D09A1887DC ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history DROP subscription_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DDE45DDE');
        $this->addSql('DROP INDEX IDX_8D93D649DDE45DDE ON user');
        $this->addSql('ALTER TABLE user DROP current_subscription_id');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8A76ED395');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('DROP INDEX IDX_DE44EFD8A76ED395 ON watch_history');
        $this->addSql('DROP INDEX IDX_DE44EFD8EA9FDD75 ON watch_history');
        $this->addSql('ALTER TABLE watch_history DROP user_id, DROP media_id');
    }
}
