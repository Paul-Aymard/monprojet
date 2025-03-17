<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208220619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alerte (id INT AUTO_INCREMENT NOT NULL, libelrdv_id INT NOT NULL, lib_alert VARCHAR(255) NOT NULL, dat_alert_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3AE753A473F25E0 (libelrdv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom_cli VARCHAR(255) NOT NULL, pre_cli VARCHAR(255) NOT NULL, tel_cli VARCHAR(255) NOT NULL, sex_cli VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_tissu (client_id INT NOT NULL, tissu_id INT NOT NULL, INDEX IDX_5DF9ECA319EB6921 (client_id), INDEX IDX_5DF9ECA3A533E0C9 (tissu_id), PRIMARY KEY(client_id, tissu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, nom_emp VARCHAR(255) NOT NULL, pre_emp VARCHAR(255) NOT NULL, tel_emp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, nom_emp_id INT NOT NULL, nom_cli_id INT NOT NULL, dat_fact_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', mont_fact VARCHAR(255) NOT NULL, INDEX IDX_FE866410FAA9AF5F (nom_emp_id), INDEX IDX_FE8664103C817DE7 (nom_cli_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, design_fou VARCHAR(255) NOT NULL, tel_fou VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur_employe (fournisseur_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_2AC49C14670C757F (fournisseur_id), INDEX IDX_2AC49C141B65292 (employe_id), PRIMARY KEY(fournisseur_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesure (id INT AUTO_INCREMENT NOT NULL, nomclient_id INT NOT NULL, nomemp_id INT NOT NULL, libel_mess VARCHAR(255) NOT NULL, INDEX IDX_5F1B6E70A261E9C8 (nomclient_id), INDEX IDX_5F1B6E705AA64001 (nomemp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, libel_mod VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele_employe (modele_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_FD89296BAC14B70A (modele_id), INDEX IDX_FD89296B1B65292 (employe_id), PRIMARY KEY(modele_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele_client (modele_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_4AE9C592AC14B70A (modele_id), INDEX IDX_4AE9C59219EB6921 (client_id), PRIMARY KEY(modele_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, nomcli_id INT NOT NULL, lib_rdv VARCHAR(255) NOT NULL, date_rdv_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_65E8AA0A9C8E92B9 (nomcli_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tissu (id INT AUTO_INCREMENT NOT NULL, design_fou_id INT NOT NULL, libel_tiss VARCHAR(255) NOT NULL, INDEX IDX_FE947014132D71F7 (design_fou_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetement (id INT AUTO_INCREMENT NOT NULL, nom_emp_id INT NOT NULL, libel_mod_id INT NOT NULL, nomcli_id INT NOT NULL, libel_vet VARCHAR(255) NOT NULL, INDEX IDX_3CB446CFFAA9AF5F (nom_emp_id), INDEX IDX_3CB446CF6E67F339 (libel_mod_id), INDEX IDX_3CB446CF9C8E92B9 (nomcli_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alerte ADD CONSTRAINT FK_3AE753A473F25E0 FOREIGN KEY (libelrdv_id) REFERENCES rendez_vous (id)');
        $this->addSql('ALTER TABLE client_tissu ADD CONSTRAINT FK_5DF9ECA319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_tissu ADD CONSTRAINT FK_5DF9ECA3A533E0C9 FOREIGN KEY (tissu_id) REFERENCES tissu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410FAA9AF5F FOREIGN KEY (nom_emp_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664103C817DE7 FOREIGN KEY (nom_cli_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE fournisseur_employe ADD CONSTRAINT FK_2AC49C14670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_employe ADD CONSTRAINT FK_2AC49C141B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mesure ADD CONSTRAINT FK_5F1B6E70A261E9C8 FOREIGN KEY (nomclient_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE mesure ADD CONSTRAINT FK_5F1B6E705AA64001 FOREIGN KEY (nomemp_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE modele_employe ADD CONSTRAINT FK_FD89296BAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_employe ADD CONSTRAINT FK_FD89296B1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_client ADD CONSTRAINT FK_4AE9C592AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_client ADD CONSTRAINT FK_4AE9C59219EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A9C8E92B9 FOREIGN KEY (nomcli_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE tissu ADD CONSTRAINT FK_FE947014132D71F7 FOREIGN KEY (design_fou_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CFFAA9AF5F FOREIGN KEY (nom_emp_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CF6E67F339 FOREIGN KEY (libel_mod_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE vetement ADD CONSTRAINT FK_3CB446CF9C8E92B9 FOREIGN KEY (nomcli_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alerte DROP FOREIGN KEY FK_3AE753A473F25E0');
        $this->addSql('ALTER TABLE client_tissu DROP FOREIGN KEY FK_5DF9ECA319EB6921');
        $this->addSql('ALTER TABLE client_tissu DROP FOREIGN KEY FK_5DF9ECA3A533E0C9');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410FAA9AF5F');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664103C817DE7');
        $this->addSql('ALTER TABLE fournisseur_employe DROP FOREIGN KEY FK_2AC49C14670C757F');
        $this->addSql('ALTER TABLE fournisseur_employe DROP FOREIGN KEY FK_2AC49C141B65292');
        $this->addSql('ALTER TABLE mesure DROP FOREIGN KEY FK_5F1B6E70A261E9C8');
        $this->addSql('ALTER TABLE mesure DROP FOREIGN KEY FK_5F1B6E705AA64001');
        $this->addSql('ALTER TABLE modele_employe DROP FOREIGN KEY FK_FD89296BAC14B70A');
        $this->addSql('ALTER TABLE modele_employe DROP FOREIGN KEY FK_FD89296B1B65292');
        $this->addSql('ALTER TABLE modele_client DROP FOREIGN KEY FK_4AE9C592AC14B70A');
        $this->addSql('ALTER TABLE modele_client DROP FOREIGN KEY FK_4AE9C59219EB6921');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A9C8E92B9');
        $this->addSql('ALTER TABLE tissu DROP FOREIGN KEY FK_FE947014132D71F7');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CFFAA9AF5F');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CF6E67F339');
        $this->addSql('ALTER TABLE vetement DROP FOREIGN KEY FK_3CB446CF9C8E92B9');
        $this->addSql('DROP TABLE alerte');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_tissu');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournisseur_employe');
        $this->addSql('DROP TABLE mesure');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE modele_employe');
        $this->addSql('DROP TABLE modele_client');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE tissu');
        $this->addSql('DROP TABLE vetement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
