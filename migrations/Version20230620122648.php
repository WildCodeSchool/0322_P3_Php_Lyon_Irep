<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620122648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation ADD exhibition_id INT NOT NULL');
        $this->addSql('ALTER TABLE presentation ADD CONSTRAINT FK_9B66E8932A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
        $this->addSql('CREATE INDEX IDX_9B66E8932A7D4494 ON presentation (exhibition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presentation DROP FOREIGN KEY FK_9B66E8932A7D4494');
        $this->addSql('DROP INDEX IDX_9B66E8932A7D4494 ON presentation');
        $this->addSql('ALTER TABLE presentation DROP exhibition_id');
    }
}
