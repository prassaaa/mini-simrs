import MasterDokterController from '@/actions/App/Http/Controllers/MasterDokterController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type MasterDokter } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { ArrowLeft, Pencil, Trash2 } from 'lucide-react';

interface Props {
    dokter: MasterDokter;
}

const breadcrumbs = (dokter: MasterDokter): BreadcrumbItem[] => [
    {
        title: 'Master Dokter',
        href: MasterDokterController.index().url,
    },
    {
        title: 'Detail Dokter',
        href: MasterDokterController.show(dokter.id).url,
    },
];

export default function Show({ dokter }: Props) {
    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus data dokter ini?')) {
            router.delete(MasterDokterController.destroy(dokter.id).url);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs(dokter)}>
            <Head title={`Detail Dokter - ${dokter.nama_dokter}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Detail Data Dokter" />
                    <div className="flex gap-2">
                        <Link href={MasterDokterController.edit(dokter.id).url}>
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
                                Kode Dokter
                            </div>
                            <div className="font-mono text-lg font-semibold">
                                {dokter.kode_dokter}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Nama Dokter
                            </div>
                            <div className="text-lg font-semibold">
                                {dokter.nama_dokter}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Spesialisasi
                            </div>
                            <div className="text-lg">
                                {dokter.spesialisasi}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                No. Telepon
                            </div>
                            <div className="text-lg">
                                {dokter.no_telp || '-'}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Dibuat pada
                            </div>
                            <div className="text-sm">
                                {format(new Date(dokter.created_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Terakhir diupdate
                            </div>
                            <div className="text-sm">
                                {format(new Date(dokter.updated_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="pt-4">
                            <Link href={MasterDokterController.index().url}>
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

