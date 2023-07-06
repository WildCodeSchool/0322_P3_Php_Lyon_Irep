<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705151756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exhibition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start DATE NOT NULL, end DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, exhibition_id INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_7E8585C82A7D4494 (exhibition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, exhibition_id INT NOT NULL, reference VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) DEFAULT NULL, technic VARCHAR(255) DEFAULT NULL, size VARCHAR(255) NOT NULL, category VARCHAR(255) DEFAULT NULL, number INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, link VARCHAR(300) DEFAULT NULL, image VARCHAR(255) NOT NULL, date DATE NOT NULL, image_crop VARCHAR(255) DEFAULT NULL, small_image VARCHAR(255) DEFAULT NULL, medium_image VARCHAR(255) DEFAULT NULL, large_image VARCHAR(255) DEFAULT NULL, INDEX IDX_16DB4F892A7D4494 (exhibition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, exhibition_id INT NOT NULL, title VARCHAR(100) NOT NULL, subtitle VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_9B66E8932A7D4494 (exhibition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C82A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F892A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
        $this->addSql('ALTER TABLE presentation ADD CONSTRAINT FK_9B66E8932A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C82A7D4494');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F892A7D4494');
        $this->addSql('ALTER TABLE presentation DROP FOREIGN KEY FK_9B66E8932A7D4494');
        $this->addSql('DROP TABLE exhibition');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
