pipeline {
    agent any

    stages {
        stage('Cloner le code') {
            steps {
                git url: 'https://github.com/faah28/gestion_etablissement.git', branch: 'main'
            }
        }

        stage('Installer les dépendances Symfony pour chaque microservice') {
            steps {
                script {
                    // Exemple pour chaque microservice
                    dir('gestion-classes') {
                        bat 'composer install --no-interaction'
                    }
                    dir('gestion-cours') {
                        bat 'composer install --no-interaction'
                    }
                    dir('gestion-etudiants') {
                        bat 'composer install --no-interaction'
                    }
                    dir('gestion-profs') {
                        bat 'composer install --no-interaction'
                    }
                    dir('gestion-emploi-temps') {
                        bat 'composer install --no-interaction'
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
