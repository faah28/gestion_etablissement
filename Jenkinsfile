pipeline {
    agent any

    stages {
        stage('Cloner le code') {
            steps {
                git url: 'https://github.com/faah28/gestion_etablissement.git', branch: 'main'
            }
        }

        stage('Build du projet') {
            steps {
                script {
                    // Exécute les commandes de build du projet
                    echo 'Building Symfony project...'
                    bat 'composer install --no-interaction'
                }
            }
        }

        stage('Exécution des tests unitaires') {
            steps {
                script {
                    // Exécute les tests unitaires Symfony
                    echo 'Running unit tests...'
                    bat 'php bin/phpunit'
                }
            }
        }

        stage('Exécution des tests IHM (Front-end)') {
            steps {
                script {
                    // Exécute les tests pour l'IHM (si applicable)
                    echo 'Running front-end tests...'
                    bat 'npm run test' // Modifier selon la commande utilisée pour tes tests front-end
                }
            }
        }

        stage('Vérification de la qualité logicielle') {
            steps {
                script {
                    // Vérification avec PHPStan ou autre outil
                    echo 'Checking code quality...'
                    bat 'php vendor/bin/phpstan analyse'
                }
            }
        }

        stage('Packaging de l\'artéfact') {
            steps {
                script {
                    // Si nécessaire, empaqueter l'artéfact pour l'envoyer à un repository
                    echo 'Packaging artifact...'
                    bat 'composer build'
                }
            }
        }

        stage('Création de l\'image Docker') {
            steps {
                script {
                    // Build des images Docker à partir des Dockerfiles
                    echo 'Building Docker images...'
                    bat 'docker-compose build'
                }
            }
        }

        stage('Dépot des artéfacts dans un repository') {
            steps {
                script {
                    // Déposer dans un repository local ou public selon l'environnement
                    echo 'Pushing artifacts to repository...'
                    // Exemple de commande pour un repository local
                    bat 'docker push local-repository/my-image:latest'
                }
            }
        }

        stage('Push de l\'image Docker dans le registry') {
            steps {
                script {
                    // Push dans un registry distant pour préprod et prod
                    echo 'Pushing Docker images to registry...'
                    bat 'docker push registry/my-image:latest'
                }
            }
        }

        stage('Provisioning de l\'environnement cible') {
            steps {
                script {
                    // Provisionner l'environnement cible si nécessaire
                    echo 'Provisioning target environment...'
                    // Exemple de commande pour un environnement de dev ou prod
                    bat 'ansible-playbook provision.yml'
                }
            }
        }

        stage('Déploiement automatique des images Docker') {
            steps {
                script {
                    // Déployer les images sur les microservices
                    echo 'Deploying Docker images...'
                    bat 'docker-compose up -d' // Peut être personnalisé selon tes besoins
                }
            }
        }
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
