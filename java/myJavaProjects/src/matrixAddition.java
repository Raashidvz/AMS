import java.util.*;
public class matrixAddition {
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        System.out.println("MATRIX ADDITION");
        System.out.print("Enter no. of rows : ");
        int row=s.nextInt();
        System.out.print("Enter no. of columns : ");
        int col=s.nextInt();

        int m1[][]=new int[row][col];
        int m2[][]=new int[row][col];
        int m3[][]=new int[row][col];
        System.out.println("Enter "+row*col+" elements for Matrix-1");
        for(int i=0;i<row;i++){
            for(int j=0;j<col;j++){
                m1[i][j]=s.nextInt();
            }
        }

        System.out.println("Enter "+row*col+" elements for Matrix-2");
        for(int i=0;i<row;i++){
            for(int j=0;j<col;j++){
                m2[i][j]=s.nextInt();
            }
        }

        //add both matrices
        for(int i=0;i<row;i++){
            for(int j=0;j<col;j++){
                m3[i][j]=m1[i][j]+m2[i][j];
            }
        }

        System.out.println("Matrix after addition");
        for(int i=0;i<row;i++){
            for(int j=0;j<col;j++){
                System.out.print(m3[i][j]+" ");
            }
            System.out.println("");
        }
    }
}
