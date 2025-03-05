pipeline {
    agent any

    environment {
        REGISTRY = "faah28" // Remplacez par votre nom Docker Hub
        PROJECT_NAME = "gestion-etablissement"
    }

    stages {
        stage('Cloner le dépôt') {
            steps {
                git branch: 'main', url: 'https://github.com/faah28/gestion_etablissement.git'
            }
        }

        stage('Build des images Docker') {
            steps {
                script {
                    def services = ['gestion-classes', 'gestion-cours', 'gestion-emploi-temps', 'gestion-etudiants', 'gestion-profs']
                    for (service in services) {
                        sh "docker build -t $REGISTRY/$PROJECT_NAME-${service}:latest ./${service}"
                    }
                }
            }
        }

        stage('Push des images Docker') {
            steps {
                script {
                    docker.withRegistry('https://index.docker.io/v1/', 'docker-hub-credentials') {
                        def services = ['gestion-classes', 'gestion-cours', 'gestion-emploi-temps', 'gestion-etudiants', 'gestion-profs']
                        for (service in services) {
                            sh "docker push $REGISTRY/$PROJECT_NAME-${service}:latest"
                        }
                    }
                }
            }
        }

        stage('Déploiement avec Docker Compose') {
            steps {
                sh 'docker-compose up -d'
            }
        }

        stage('Tests') {
            steps {
                script {
                    def services = ['gestion-classes', 'gestion-cours', 'gestion-emploi-temps', 'gestion-etudiants', 'gestion-profs']
                    for (service in services) {
                        sh "docker exec ${service} php artisan test || echo 'Tests échoués'"
                    }
                }
            }
        }

        stage('Nettoyage') {
            steps {
                sh 'docker system prune -f'
            }
        }
    }
}
