<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301091247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP CONSTRAINT fk_23a0e66f603ee73');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT fk_cfbdfa14f603ee73');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f5299398f603ee73');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT fk_ba388b76c755722');
        $this->addSql('ALTER TABLE feedback DROP CONSTRAINT fk_d22944586c755722');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT fk_cfbdfa146c755722');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f52993986c755722');
        $this->addSql('DROP SEQUENCE buyer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vendor_id_seq CASCADE');
        $this->addSql('DROP TABLE vendor');
        $this->addSql('DROP TABLE buyer');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66F603EE73');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F603EE73 FOREIGN KEY (vendor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B76C755722');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B76C755722 FOREIGN KEY (buyer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feedback DROP CONSTRAINT FK_D22944586C755722');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944586C755722 FOREIGN KEY (buyer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA146C755722');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA14F603EE73');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA146C755722 FOREIGN KEY (buyer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14F603EE73 FOREIGN KEY (vendor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993986C755722');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398F603EE73');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993986C755722 FOREIGN KEY (buyer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398F603EE73 FOREIGN KEY (vendor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD discr VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D649979B1AD6 ON "user" (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE buyer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vendor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vendor (id INT NOT NULL, company_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f52233f6979b1ad6 ON vendor (company_id)');
        $this->addSql('CREATE TABLE buyer (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE vendor ADD CONSTRAINT fk_f52233f6979b1ad6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649979B1AD6');
        $this->addSql('DROP INDEX IDX_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE "user" DROP company_id');
        $this->addSql('ALTER TABLE "user" DROP discr');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT fk_23a0e66f603ee73');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT fk_23a0e66f603ee73 FOREIGN KEY (vendor_id) REFERENCES vendor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT fk_ba388b76c755722');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT fk_ba388b76c755722 FOREIGN KEY (buyer_id) REFERENCES buyer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feedback DROP CONSTRAINT fk_d22944586c755722');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT fk_d22944586c755722 FOREIGN KEY (buyer_id) REFERENCES buyer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT fk_cfbdfa146c755722');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT fk_cfbdfa14f603ee73');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT fk_cfbdfa146c755722 FOREIGN KEY (buyer_id) REFERENCES buyer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT fk_cfbdfa14f603ee73 FOREIGN KEY (vendor_id) REFERENCES vendor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f52993986c755722');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT fk_f5299398f603ee73');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f52993986c755722 FOREIGN KEY (buyer_id) REFERENCES buyer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT fk_f5299398f603ee73 FOREIGN KEY (vendor_id) REFERENCES vendor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
