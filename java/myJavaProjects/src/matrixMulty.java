import java.util.*;
public class matrixMulty {
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        System.out.println("Matrix-1");
        System.out.print("No. of rows : ");
        int row1=s.nextInt();
        System.out.print("No. of columns : ");
        int col1=s.nextInt();

        int m1[][]=new int[row1][col1];
        System.out.println("Enter "+row1*col1+" matrix-1 elements");
        for(int i=0;i<row1;i++){
            for(int j=0;j<col1;j++){
                m1[i][j]=s.nextInt();
            }
        }

        System.out.println("Matrix-2");
        System.out.print("No. of rows : ");
        int row2=s.nextInt();
        System.out.print("No. of columns : ");
        int col2=s.nextInt();

        int m2[][]=new int[row2][col2];
        System.out.println("Enter "+row2*col2+" matrix-2 elements");
        for(int i=0;i<row2;i++){
            for(int j=0;j<col2;j++){
                m2[i][j]=s.nextInt();
            }
        }
        
        if(col1==row2){
            int m3[][]=new int[row1][col2];
            for(int i=0;i<row1;i++){
                for(int j=0;j<col2;j++){
                    m3[i][j]=0;
                    for(int k=0;k<col1;k++){
                        m3[i][j]=m3[i][j]+m1[i][k]*m2[k][j];
                    }
                }
            }

            System.out.println("Matrix after multiplication");
            for(int i=0;i<row1;i++){
                for(int j=0;j<col2;j++){
                    System.out.print(m3[i][j]+" ");
                }
                System.out.println("");
            }
        }else{
            System.out.println("Matrix multiplication is not possible");
        }

    }
}
