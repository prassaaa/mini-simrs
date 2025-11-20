import MasterPoliController from '@/actions/App/Http/Controllers/MasterPoliController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type MasterPoli } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { ArrowLeft, Pencil, Trash2 } from 'lucide-react';

interface Props {
    poli: MasterPoli;
}

const breadcrumbs = (poli: MasterPoli): BreadcrumbItem[] => [
    {
        title: 'Master Poli',
        href: MasterPoliController.index().url,
    },
    {
        title: 'Detail Poli',
        href: MasterPoliController.show(poli.id).url,
    },
];

export default function Show({ poli }: Props) {
    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus data poli ini?')) {
            router.delete(MasterPoliController.destroy(poli.id).url);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs(poli)}>
            <Head title={`Detail Poli - ${poli.nama_poli}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Detail Data Poli" />
                    <div className="flex gap-2">
                        <Link href={MasterPoliController.edit(poli.id).url}>
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
                                Kode Poli
                            </div>
                            <div className="font-mono text-lg font-semibold">
                                {poli.kode_poli}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Nama Poli
                            </div>
                            <div className="text-lg font-semibold">
                                {poli.nama_poli}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Lokasi
                            </div>
                            <div className="text-lg">
                                {poli.lokasi || '-'}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Dibuat pada
                            </div>
                            <div className="text-sm">
                                {format(new Date(poli.created_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Terakhir diupdate
                            </div>
                            <div className="text-sm">
                                {format(new Date(poli.updated_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="pt-4">
                            <Link href={MasterPoliController.index().url}>
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

