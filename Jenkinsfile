pipeline {
    agent any

    stages {
        stage('Cloner le code') {
            steps {
                git url: 'https://github.com/faah28/gestion_etablissement.git', branch: 'main'
            }
        }

    

        stage('Packaging de l\'artéfact') {
    steps {
        script {
            // Remplacer la syntaxe de la variable pour qu'elle soit interprétée
            def artifact_name = "gestionEtablissement-${BUILD_NUMBER}.tar.gz"

            dir('C:\\laragon\\www\\Gestion_etablissement') {
                // Créer l'archive tar.gz en utilisant la variable correctement
                bat "tar -czvf ${artifact_name} gestion-classes gestion-cours gestion-emploi-temps gestion-etudiants gestion-profs"
            }
        }
    }
}

        stage('Construire les images Docker') {
            steps {
                script {
                    bat 'docker-compose up -d --no-build'
                }
            }
        }

        // Ajouter d'autres stages comme les tests, packaging, etc.
    }

    post {
        success {
            echo '🎉 Pipeline réussie et artéfact publié !'
        }
        failure {
            echo '⚠️ Erreur dans la pipeline, vérifiez les logs.'
        }
    }
}
