import java.util.*;
public class commonElements {
    static int compressArray(int size,int ar[],int compAr[]){
        //compress array (remove repeated elements)
        compAr[0]=ar[0];
        int n=1,flag;
        for(int i=1;i<size;i++){
            flag=0;
            for(int j=0;j<n;j++){
                if(ar[i]==compAr[j]){
                    flag=1;
                    break;
                }
            }
            if(flag!=1){
                compAr[n]=ar[i];
                n++;
            }
        }
        return n;
    }
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        System.out.println("Enter size of first array");
        int size1=s.nextInt();
        int a[]=new int[size1];
        System.out.println("Enter "+size1+" elements for first array");
        for(int i=0;i<size1;i++){
            a[i]=s.nextInt();
        }
        int compA[]=new int[size1];
        int n1=compressArray(size1,a,compA);
        
        System.out.println("Enter size of second array");
        int size2=s.nextInt();
        int b[]=new int[size2];
        System.out.println("Enter "+size2+" elements of second array");
        for(int i=0;i<size2;i++){
            b[i]=s.nextInt();
        }
        int compB[]=new int[size2];
        int n2=compressArray(size2,b,compB);

        //check for common elements
        int size3,k=0;
        size3=size1>size2?size2:size1;
        int c[]=new int[size3];
        for(int i=0;i<n1;i++){
            for(int j=0;j<n2;j++){
                if(compA[i]==compB[j]){
                    c[k]=compA[i];
                    k++;
                    break;
                }
            }
        }

        if(k==0){
            System.out.println("No common elements found");
        }else{
            System.out.println("Common elements are");
            for(int i=0;i<k;i++){
                System.out.print(c[i]+" ");
            }
        }
    }
}
