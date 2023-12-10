Feature: Espace membre, accueil

  @reloadDbWithTestData
  Scenario: L'accueil affiche le nom et prénom du compte
    Given I am logged in as admin
    And I follow "Espace membre"
    Then I should see "Espace membre"
    And I should see "Mes coordonnées : Admin Admin"

  @reloadDbWithTestData
  Scenario: On arrive bien à définir son antenne la plus proche
    Given I am logged in as admin
    And I follow "Espace membre"
    Then I should see "Espace membre"
    And I should see "Antenne la plus proche : Aucune"
    When I follow "Définir"
    Then I should see "Mes coordonnées"

  @reloadDbWithTestData
  Scenario: On arrive bien à définir changer ses coordonnées
    Given I am logged in as admin
    And I follow "Espace membre"
    Then I should see "Espace membre"
    And I should see "Antenne la plus proche : Aucune"
    When I follow "Définir"
    Then I should see "Mes coordonnées"
    When I fill in "contact_details[nearest_office]" with "lyon"
    And I fill in "contact_details[address]" with "42 rue des lilas"
    And I fill in "contact_details[zipcode]" with "75001"
    And I fill in "contact_details[city]" with "Lyon Cedex"
    And I press "Modifier"
    Then I should see "Votre compte a été modifié"
    When I follow "Espace membre"
    Then I should see "Antenne la plus proche : Lyon"
    When I follow "Modifier"
    Then the "contact_details[address]" field should contain "42 rue des lilas"
    And the "contact_details[zipcode]" field should contain "75001"
    And the "contact_details[city]" field should contain "Lyon Cedex"

  @reloadDbWithTestData
  Scenario: On peux télécharger la facture de cotisation pour une personne physique
    Given I am logged-in with the user "userexpire" and the password "userexpire"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Se mettre à jour"
    Then I should see "Payer ma cotisation"
    When I follow "Télécharger la facture"
    Then the response header "Content-disposition" should equal 'attachment; filename="Maurice_COTIS-2018-198_13072018.pdf"'

  @reloadDbWithTestData @vat
  Scenario: Test d'une facture de cotisation de personne physique avant 2024
    Given I am logged-in with the user "cpike" and the password "cpike"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Consulter"
    Then I should see "Payer ma cotisation"
    When I follow "Télécharger la facture pour la cotisation COTIS-2023-1"
    Then the response header "Content-disposition" should equal 'attachment; filename="Pike_COTIS-2023-1_01012023.pdf"'
    Given I parse the pdf downloaded content
    Then The page "1" of the PDF should contain "Objet : Facture n°COTIS-2023-1"
    Then The page "1" of the PDF should contain "Christopher Pike"
    Then The page "1" of the PDF should contain "15, main road"
    Then The page "1" of the PDF should contain "93501-1100"
    Then The page "1" of the PDF should contain "Mojave, CA"
    Then The page "1" of the PDF should contain "Code Désignation Prix"
    Then The page "1" of the PDF should contain "ADH Adhésion AFUP jusqu'au 01/01/2024 30.00 €"
    Then The page "1" of the PDF should contain "TVA non applicable - art. 293B du CGI"
    Then The page "1" of the PDF should not contain "Numéro de TVA intercommunautaire NUMERO_A_AJOUTER"
    Then the checksum of the response content should be "e869bc7f6406b276ba4a7ac845aabafc"

  @reloadDbWithTestData @vat
  Scenario: Test d'une facture de cotisation de personne physique à partir de 2024
    Given I am logged-in with the user "cpike" and the password "cpike"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Consulter"
    Then I should see "Payer ma cotisation"
    When I follow "Télécharger la facture pour la cotisation COTIS-2024-245"
    Then the response header "Content-disposition" should equal 'attachment; filename="Pike_COTIS-2024-245_01012024.pdf"'
    Given I parse the pdf downloaded content
    Then The page "1" of the PDF should contain "Objet : Facture n°COTIS-2024-245"
    Then The page "1" of the PDF should contain "Christopher Pike"
    Then The page "1" of the PDF should contain "15, main road"
    Then The page "1" of the PDF should contain "93501-1100"
    Then The page "1" of the PDF should contain "Mojave, CA"
    Then The page "1" of the PDF should contain "Code Désignation Prix"
    Then The page "1" of the PDF should contain "ADH Adhésion AFUP jusqu'au 01/01/2025 30.00 €"
    Then The page "1" of the PDF should contain "TVA non applicable - art. 293B du CGI"
    Then The page "1" of the PDF should not contain "Numéro de TVA intercommunautaire NUMERO_A_AJOUTER"
    Then the checksum of the response content should be "f3c953196f966bf99c385957bb38bd83"

  @reloadDbWithTestData @vat
  Scenario: Test d'une facture de cotisation de personne morale avant 2024
    Given I am logged-in with the user "dayesa" and the password "dayesa"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Consulter"
    Then I should see "Payer ma cotisation"
    When I follow "Télécharger la facture pour la cotisation COTIS-2023-2"
    Then the response header "Content-disposition" should equal 'attachment; filename="HeliosAerospace_COTIS-2023-2_02012023.pdf"'
    Given I parse the pdf downloaded content
    Then The page "1" of the PDF should contain "Objet : Facture n°COTIS-2023-2"
    Then The page "1" of the PDF should contain "Helios Aerospace"
    Then The page "1" of the PDF should contain "8, main road"
    Then The page "1" of the PDF should contain "77201"
    Then The page "1" of the PDF should contain "Houston, TX"
    Then The page "1" of the PDF should contain "Code Désignation Prix"
    Then The page "1" of the PDF should contain "ADH Adhésion AFUP jusqu'au 02/01/2024 150.00 €"
    Then The page "1" of the PDF should contain "TVA non applicable - art. 293B du CGI"
    Then The page "1" of the PDF should not contain "Numéro de TVA intercommunautaire NUMERO_A_AJOUTER"
    Then the checksum of the response content should be "7feed06ea4905cb0bf198c4f1cf6d211"

  @reloadDbWithTestData @vat
  Scenario: Test d'une facture de cotisation de personne morale à partir de 2024
    Given I am logged-in with the user "dayesa" and the password "dayesa"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Consulter"
    Then I should see "Payer ma cotisation"
    When I follow "Télécharger la facture pour la cotisation COTIS-2024-249"
    Then the response header "Content-disposition" should equal 'attachment; filename="HeliosAerospace_COTIS-2024-249_02012024.pdf"'
    Given I parse the pdf downloaded content
    Then The page "1" of the PDF should contain "Objet : Facture n°COTIS-2024-249"
    Then The page "1" of the PDF should contain "Helios Aerospace"
    Then The page "1" of the PDF should contain "8, main road"
    Then The page "1" of the PDF should contain "77201"
    Then The page "1" of the PDF should contain "Houston, TX"
    Then The page "1" of the PDF should contain "Code Désignation Prix"
    Then The page "1" of the PDF should contain "ADH Adhésion AFUP jusqu'au 02/01/2025 150.00 €"
    Then The page "1" of the PDF should contain "TVA non applicable - art. 293B du CGI"
    Then The page "1" of the PDF should not contain "Numéro de TVA intercommunautaire NUMERO_A_AJOUTER"
    Then the checksum of the response content should be "15221d31bd121a16f5edf28b82adc76d"

  @reloadDbWithTestData
  Scenario: On peux télécharger la facture de cotisation pour une personne morale
    Given I am logged-in with the user "edmonddupont" and the password "edmonddupont"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Consulter"
    Then I should see "Payer ma cotisation"
    When I follow "Télécharger la facture"
    Then the response header "Content-disposition" should equal 'attachment; filename="MyCorp_COTIS-2023-200_13072018.pdf"'

  @reloadDbWithTestData
  Scenario: Si on est pas company manager de la personne morale, on ne peux pas télécharger la facture
    Given I am logged-in with the user "raoul" and the password "raoul"
    And I follow "Espace membre"
    Then I should see "Cotisations"
    When I follow "Consulter"
    Then I should see "Payer ma cotisation"
    Then I should not see "Télécharger la facture"
    When I am on "/member/membership-fee/download?id=3"
    Then the response status code should be 403
