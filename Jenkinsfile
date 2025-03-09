pipeline {
    agent any

    environment {
        LOCAL_REGISTRY = "localhost:5000"
        REMOTE_REGISTRY = "docker.io/faah28"
        ENV = "dev"  // Change en "staging" ou "prod" selon le besoin
    }

    stages {
        stage('Cloner le code') {
            steps {
                checkout scm
            }
        }

        stage('Construire les images Docker') {
            steps {
                script {
                    bat "docker-compose build"
                }
            }
        }

        stage('Push de l\'image Docker') {
            steps {
                script {
                    def registry = (ENV == 'dev' || ENV == 'staging') ? LOCAL_REGISTRY : REMOTE_REGISTRY
                    def imageTag = "${registry}/gestionEtablissement:${BUILD_NUMBER}"

                    bat "docker tag gestionEtablissement ${imageTag}"
                    bat "docker push ${imageTag}"
                    echo "✅ Image Docker poussée vers ${registry}"
                }
            }
        }

         stages {
        stage('Test') {
            steps {
                echo '🚀 Le pipeline est bien exécuté !'
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
