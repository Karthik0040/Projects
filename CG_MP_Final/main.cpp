#include <GL/glut.h>
#include <stdlib.h>
#include <stdio.h>
#include <stdbool.h>
#include <math.h>
#include <time.h>

#define PLANE_SIZE 20.0f
#define COIN_RADIUS 1.0f
#define CUBE_SIZE 2.0f
#define PI 3.1415

void createEndWindow();
void createSecondWindow();

int mainWindow;
int secondWindow;
int endWindow;

float cameraRadius = 25.0;
float cameraAngle = 0.0;
float cameraHeight = 20.0;
float cubeX = 0.0f;
float cubeZ = 0.0f;
int coinCount = 0;
int numCoins = 5;
bool coinsVisible = true;
float coinX[5] = { -5.0f, 7.0f, -3.0f, 9.0f, 0.0f };
float coinZ[5] = { 3.0f, -2.0f, 10.0f, -4.0f, 6.0f };
float cubeColor[4] = {1.0,1.0,1.0,1.0};
int level =1;

void drawPlane() {
    glColor3f(0.5f, 0.5f, 0.5f);
    glBegin(GL_QUADS);
    glVertex3f(-PLANE_SIZE, 0.0f, -PLANE_SIZE);
    glVertex3f(-PLANE_SIZE, 0.0f, PLANE_SIZE);
    glVertex3f(PLANE_SIZE, 0.0f, PLANE_SIZE);
    glVertex3f(PLANE_SIZE, 0.0f, -PLANE_SIZE);
    glEnd();
}

void drawCoin(float x, float z) {
    glColor3f(1.0f, 1.0f, 0.0f);
    glPushMatrix();
    glTranslatef(x, COIN_RADIUS, z);
    glRotatef(90.0f, 1.0f, 0.0f, 0.0f);
    glScalef(1.0f, 0.3f, 1.0f);

    glutSolidSphere(COIN_RADIUS, 20, 20);

    glPopMatrix();
}

void drawCube() {
    //To check if the cube move out of plane
    if(cubeX >= PLANE_SIZE || cubeX <= -PLANE_SIZE || cubeZ >= PLANE_SIZE || cubeZ <= -PLANE_SIZE)
    {
        glPushMatrix();
        glTranslated(-5,15.0,-2.0);
        glPopMatrix();
        glutDestroyWindow(secondWindow);
        createEndWindow();
    }
    else
    {
        glTranslatef(cubeX, CUBE_SIZE / 2.0f, cubeZ);
        glutSolidCube(CUBE_SIZE);
    }
}

void displayMain() {
    float x = 150,y = 350;
    glClear(GL_COLOR_BUFFER_BIT);
    glColor3f(1.0, 1.0, 1.0);
    glRasterPos2f(400, 400);
    const char* projectTitle = "COIN QUEST";
    for (int i = 0; i < strlen(projectTitle); i++) {
        glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, projectTitle[i]);
    }

    glRasterPos2f(x, y);
    const char* paragraph = "The COIN QUEST is a simple interactive game implemented using OpenGL \n and GLUT library in C programming language. The objective of the \n game is to collect as many  coins as possible while navigating a 3D environment.";
    for (int i = 0; i < strlen(paragraph); i++) {
        if(paragraph[i] == '\n'){
                y -= 20;
            glRasterPos2f(x,y);
        }
        glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18, paragraph[i]);
    }

    glRasterPos2f(280, 250);
    const char* teamMembers = "Team Members:   K TEJAS PRABHU,   KARTHIK";
    for (int i = 0; i < strlen(teamMembers); i++) {
        glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18, teamMembers[i]);
    }

    glRasterPos2f(420, 200);
    const char* instruction = "Press 'Enter' to start.";
    for (int i = 0; i < strlen(instruction); i++) {
        glutBitmapCharacter(GLUT_BITMAP_HELVETICA_12, instruction[i]);
    }
    glFlush();
}

void reshapeMain(int w, int h) {
    glViewport(0, 0, w, h);
    glMatrixMode(GL_PROJECTION);
    glLoadIdentity();
    gluOrtho2D(0, w, 0, h);
}

void keyboard(unsigned char key, int x, int y) {
    if (key == 13) {
        glutDestroyWindow(mainWindow);
        createSecondWindow();
    }
}

void createMainWindow() {
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
    glutInitWindowSize(1000, 600);
    glutInitWindowPosition(100, 100);
    mainWindow = glutCreateWindow("Main Window");

    glClearColor(0.0, 0.0, 0.0, 1.0);

    glutDisplayFunc(displayMain);
    glutReshapeFunc(reshapeMain);
    glutKeyboardFunc(keyboard);

    glutMainLoop();
}

void reshape(int width, int height) {
    glViewport(0, 0, width, height);
    glMatrixMode(GL_PROJECTION);
    glLoadIdentity();
    glFrustum(-0.1f, 0.1f, -0.1f * (float)height / width, 0.1f * (float)height / width, 0.1f, 50.0f);
    glMatrixMode(GL_MODELVIEW);
}

void Keys(unsigned char key, int x, int y) {
    switch (key) {
        case 'a':
            cubeX -= 1.0f;
            break;
        case 'd':
            cubeX += 1.0f;
            break;
        case 'w':
            cubeZ -= 1.0f;
            break;
        case 's':
            cubeZ += 1.0f;
            break;
    }
    for (int i = 0; i < 5; i++) {
        if (coinX[i] != -100.0f) {
                //To check if cube touches the coin
            if (cubeX >= coinX[i] - COIN_RADIUS && cubeX <= coinX[i] + COIN_RADIUS &&
                cubeZ >= coinZ[i] - COIN_RADIUS && cubeZ <= coinZ[i] + COIN_RADIUS) {
                coinCount++;

                coinX[i] = -100.0f;
                coinZ[i] = -100.0f;
                if (!(coinCount%5)) {
                    srand(time(0));

                    for (int i = 0; i < 5; i++) {
                        int randomNum = rand() % 39 - 18;
                        coinX[i] = randomNum;
                    }
                    for (int i = 0; i < 5; i++) {
                        int randomNum = rand() % 38 - 18;
                        coinZ[i] = randomNum;
                    }
                    level++;
                }
                break;
            }
        }
    }
    glutPostRedisplay();
}

void Keys2(int key, int x, int y) {
    switch (key) {
        case GLUT_KEY_LEFT:
            cameraAngle -= 0.1;
            break;
        case GLUT_KEY_RIGHT:
            cameraAngle += 0.1;
            break;
        case GLUT_KEY_UP:
            cameraAngle -= 0.1;
            break;
        case GLUT_KEY_DOWN:
            cameraAngle += 0.1;
            break;
        case GLUT_KEY_HOME:
            cameraAngle = 0;
    }
    glutPostRedisplay();
}

void displaySecond() {
    GLfloat mat_ambient[] ={1.0f,1.0f,1.0f,1.0f};
    GLfloat mat_diffuse_plane[] = {1.0,1.0,1.2,0.0};
    GLfloat mat_diffuse_cube[] = {1.0,1.5,1.0,1.0};
    GLfloat mat_diffuse_coin[] = {1.0,0.8,0.0,1.0};

    GLfloat mat_specular[] = {1.0,1.0,1.0,1.0};
    GLfloat mat_shininess[] = {50.0};

    glMaterialfv(GL_FRONT,GL_AMBIENT,mat_ambient);
    glMaterialfv(GL_FRONT,GL_DIFFUSE,mat_diffuse_plane);
    glMaterialfv(GL_FRONT,GL_SPECULAR,mat_specular);
    glMaterialfv(GL_FRONT,GL_SHININESS,mat_shininess);

    GLfloat lightIntensity[] = {1.0f,1.0f,1.0f,1.0f};
    GLfloat lightPosition[] = {2.0f,6.0f,3.0f,0.0f};
    glLightfv(GL_LIGHT0, GL_POSITION, lightPosition);
    glLightfv(GL_LIGHT0, GL_DIFFUSE, lightIntensity);

    glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
    glLoadIdentity();

    float cameraX = cameraRadius * sin(cameraAngle);
    float cameraZ = cameraRadius * cos(cameraAngle);
    gluLookAt(cameraX, cameraHeight, cameraZ, 0.0, 0.0, 0.0, 0.0, 1.0, 0.0);

    drawPlane();

    if (coinsVisible) {
        for (int i = 0; i < numCoins; i++) {
            if (coinX[i] != -100.0f) {
                glMaterialfv(GL_FRONT,GL_DIFFUSE,mat_diffuse_coin);
                drawCoin(coinX[i], coinZ[i]);
            }
        }
    }
    glPushMatrix();
    glMaterialfv(GL_FRONT,GL_DIFFUSE,cubeColor);
    drawCube();
    glPopMatrix();

    char text[50];
    sprintf(text, "Level : %d \t Coins Collected: %d ",level, coinCount);
    glRasterPos2f(-5, 20);
    for (int i = 0; i < strlen(text); i++) {
        glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18, text[i]);
    }

    glutSwapBuffers();
}

void init() {
    glClearColor(1.0f, 1.0f, 1.0f, 1.0f);
    glEnable(GL_DEPTH_TEST);
}

void createSecondWindow()
{
    glutInitDisplayMode(GLUT_DOUBLE | GLUT_RGB | GLUT_DEPTH);
    glutInitWindowSize(1000, 1000);
    glutInitWindowPosition(0, 0);
    secondWindow = glutCreateWindow("Second Window");

    init();

    glutDisplayFunc(displaySecond);
    glutReshapeFunc(reshape);
    glutKeyboardFunc(Keys);
    glutSpecialFunc(Keys2);

    glEnable(GL_LIGHTING);
    glEnable(GL_LIGHT0);
    glEnable(GL_NORMALIZE);
    glShadeModel(GL_SMOOTH);

    glutMainLoop();
}

void displayEnd()
{
    glClear(GL_COLOR_BUFFER_BIT);
    glColor3f(1.0, 1.0, 1.0);

    glRasterPos2f(400, 400);
    const char* projectTitle = "COIN QUEST";
    for (int i = 0; i < strlen(projectTitle); i++) {
        glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, projectTitle[i]);
    }

    glRasterPos2f(380, 300);
    char score[20];
    sprintf(score,"Your total score is :      %d",coinCount);
    for (int i = 0; i < strlen(score); i++) {
        glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18, score[i]);
    }

    glRasterPos2f(380, 200);
    const char* teamMembers = "Press 'n' or 'N' to start a new game.";
    for (int i = 0; i < strlen(teamMembers); i++) {
        glutBitmapCharacter(GLUT_BITMAP_HELVETICA_12, teamMembers[i]);
    }

    glFlush();
}

void reshapeEnd(int w, int h)
{
    glViewport(0, 0, w, h);
    glMatrixMode(GL_PROJECTION);
    glLoadIdentity();
    gluOrtho2D(0, w, 0, h);
}

void newGame(unsigned char key, int x, int y) {
    if (key == 'n' || key == 'N') {
        glutDestroyWindow(endWindow);
        cubeX = 0;
        cubeZ = 0;
        coinCount = 0;
        srand(time(0));

        for (int i = 0; i < 5; i++) {
            int randomNum = rand() % 39 - 18;
            coinX[i] = randomNum;
        }
        for (int i = 0; i < 5; i++) {
            int randomNum = rand() % 38 - 18;
            coinZ[i] = randomNum;
        }
        level = 1;
        createSecondWindow();
    }
}

void createEndWindow()
{
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
    glutInitWindowSize(1000, 600);
    glutInitWindowPosition(100, 100);
    mainWindow = glutCreateWindow("Game Over Window");

    glClearColor(0.0, 0.0, 0.0, 1.0);

    glutDisplayFunc(displayEnd);
    glutReshapeFunc(reshapeEnd);
    glutKeyboardFunc(newGame);

    glutMainLoop();
}

int main(int argc, char** argv) {
    glutInit(&argc, argv);
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);

    createMainWindow();
    glutMainLoop();
    return 0;
}
