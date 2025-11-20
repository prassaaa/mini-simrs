import PasienController from '@/actions/App/Http/Controllers/PasienController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type Pasien } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { ArrowLeft, Pencil, Trash2 } from 'lucide-react';

interface Props {
    pasien: Pasien;
}

const breadcrumbs = (pasien: Pasien): BreadcrumbItem[] => [
    {
        title: 'Data Pasien',
        href: PasienController.index().url,
    },
    {
        title: 'Detail Pasien',
        href: PasienController.show(pasien.id).url,
    },
];

export default function Show({ pasien }: Props) {
    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus data pasien ini?')) {
            router.delete(PasienController.destroy(pasien.id).url);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs(pasien)}>
            <Head title={`Detail Pasien - ${pasien.nama_pasien}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Detail Data Pasien" />
                    <div className="flex gap-2">
                        <Link href={PasienController.edit(pasien.id).url}>
                            <Button variant="outline">
                                <Pencil className="mr-2 h-4 w-4" />
                                Edit
                            </Button>
                        </Link>
                        <Button variant="destructive" onClick={handleDelete}>
                            <Trash2 className="mr-2 h-4 w-4" />
                            Hapus
                        </Button>
                    </div>
                </div>

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <div className="space-y-6">
                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                No. Rekam Medis
                            </div>
                            <div className="text-lg font-semibold">{pasien.no_rm}</div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Nama Pasien
                            </div>
                            <div className="text-lg font-semibold">{pasien.nama_pasien}</div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Tanggal Lahir
                            </div>
                            <div className="text-lg">
                                {format(new Date(pasien.tanggal_lahir), 'dd MMMM yyyy')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Jenis Kelamin
                            </div>
                            <div className="text-lg">
                                {pasien.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Alamat
                            </div>
                            <div className="text-lg">{pasien.alamat}</div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Dibuat pada
                            </div>
                            <div className="text-sm">
                                {format(new Date(pasien.created_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Terakhir diupdate
                            </div>
                            <div className="text-sm">
                                {format(new Date(pasien.updated_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="pt-4">
                            <Link href={PasienController.index().url}>
                                <Button variant="outline">
                                    <ArrowLeft className="mr-2 h-4 w-4" />
                                    Kembali
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}

