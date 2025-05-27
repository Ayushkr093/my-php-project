pipeline {

    agent any

    environment {
        DOCKER_REGISTRY = 'ayushkr08'
        APP_IMAGE = 'my_php_appp'
        GIT_BRANCH = 'main'
        GIT_REPO_URL = 'https://github.com/Ayushkr093/my-php-project.git'
        COMMIT_HASH = ''
    }

    stages {
        stage('Clone Git Repository') {
            steps {
                script {
                    echo 'Cloning repository...'
                    sh 'rm -rf my-php-project'
                    sh "git clone ${GIT_REPO_URL} my-php-project"
                    dir('my-php-project') {
                        sh "git checkout ${GIT_BRANCH}"
                        COMMIT_HASH = sh(script: "git rev-parse --short HEAD", returnStdout: true).trim()
                        env.COMMIT_HASH = COMMIT_HASH
                    }
                }
            }
        }

        stage('Login to Docker Hub') {
            steps {
                script {
                    echo 'Logging in to Docker Hub...'
                    withCredentials([usernamePassword(credentialsId: 'DOCKER_CREDENTIALS', usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
                        sh 'echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin'
                    }
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    echo "Building Docker image with tag: ${COMMIT_HASH}"
                    docker.build("${DOCKER_REGISTRY}/${APP_IMAGE}:${COMMIT_HASH}", './my-php-project')
                }
            }
        }

        stage('Push Docker Image to Docker Hub') {
            steps {
                script {
                    echo 'Pushing Docker image to Docker Hub...'
                    docker.image("${DOCKER_REGISTRY}/${APP_IMAGE}:${COMMIT_HASH}").push()
                }
            }
        }

        stage('Run with Docker Compose') {
            steps {
                script {
                    echo 'Running app with Docker Compose...'
                    dir('my-php-project') {
                        sh 'docker-compose down --volumes --remove-orphans'
                        sh "TAG=${COMMIT_HASH} docker-compose up -d --build"
                    }
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up unused Docker resources...'
            sh 'docker system prune -f --volumes || true'
        }
    }
}
