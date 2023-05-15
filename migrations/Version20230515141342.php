<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515141342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F386D8D01');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6995AC4C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6B92BD7B');
        $this->addSql('DROP INDEX IDX_B6BD307F6995AC4C ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F386D8D01 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F6B92BD7B ON message');
        $this->addSql('ALTER TABLE message DROP editor_id, DROP receptor_id, DROP conversation_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD editor_id INT DEFAULT NULL, ADD receptor_id INT DEFAULT NULL, ADD conversation_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F386D8D01 FOREIGN KEY (receptor_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6995AC4C FOREIGN KEY (editor_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6B92BD7B FOREIGN KEY (conversation_id_id) REFERENCES conversation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B6BD307F6995AC4C ON message (editor_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F386D8D01 ON message (receptor_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F6B92BD7B ON message (conversation_id_id)');
    }
}
